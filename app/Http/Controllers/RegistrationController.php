<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\PaymentSetting;
use App\Models\Registration;
use App\Services\RegistrationEmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function show(string $reference): View
    {
        $registration = Registration::with('participants')
            ->where('reference', $reference)
            ->firstOrFail();

        $tierLabel = 'Registration Fee';

        $paybillOption = PaymentSetting::get('option_paybill', '');
        $bankOption = PaymentSetting::get('option_kcb', '');
        $isPaybill = $paybillOption && str_contains($registration->payment_mode, $paybillOption);
        $isBankTransfer = $bankOption && str_contains($registration->payment_mode, $bankOption);
        $paymentDetails = [
            'bank_name' => PaymentSetting::get('kcb_bank_name', 'Co-operative Bank'),
            'bank_account_name' => PaymentSetting::get('kcb_account_name'),
            'bank_account_number' => PaymentSetting::get('kcb_account_number', '01103095242001'),
            'paybill_number' => PaymentSetting::get('paybill_number', '400200'),
            'paybill_account' => PaymentSetting::get('paybill_account_number', '01103095242001'),
            'cheque_payee' => PaymentSetting::get('cheque_payee'),
        ];

        return view('thank-you', compact('registration', 'tierLabel', 'isPaybill', 'isBankTransfer', 'paymentDetails'));
    }

    public function store(StoreRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $rate = $request->rateForTier($validated['tier']);
        $reference = 'IBD-'.strtoupper(Str::random(6));

        $registration = DB::transaction(function () use ($validated, $rate, $reference) {
            $registration = Registration::create([
                'reference' => $reference,
                'school_name' => $validated['school_name'],
                'school_type' => $validated['school_type'],
                'county' => $validated['county'],
                'address' => $validated['address'] ?? null,
                'school_phone' => $validated['p_phone'],
                'school_email' => $validated['p_email'],
                'lead_name' => $validated['p_name'],
                'lead_role' => $validated['p_role'],
                'lead_phone' => $validated['p_phone'],
                'lead_email' => $validated['p_email'],
                'tier' => 'standard',
                'participant_count' => 1,
                'rate_per_participant' => $rate,
                'total_amount' => $rate,
                'accessibility' => $validated['accessibility'] ?? null,
                'dietary' => $validated['dietary'] ?? null,
                'payment_mode' => $validated['payment_mode'],
                'confirm_authority' => false,
                'confirm_attendance' => true,
                'consent_comms' => (bool) ($validated['consent_comms'] ?? false),
                'status' => 'pending',
            ]);

            $registration->participants()->create([
                'position' => 1,
                'name' => $validated['p_name'],
                'role' => $validated['p_role'],
                'subject' => $validated['p_subject'] ?? null,
                'years' => isset($validated['p_years']) && $validated['p_years'] !== ''
                    ? (int) $validated['p_years']
                    : null,
                'phone' => $validated['p_phone'],
                'email' => $validated['p_email'],
            ]);

            return $registration->load('participants');
        });

        app(RegistrationEmailService::class)->sendRegistrationReceived($registration);

        return response()->json([
            'message' => 'Registration submitted successfully.',
            'reference' => $registration->reference,
            'redirect_url' => route('registrations.thank-you', $registration->reference),
            'total' => $registration->total_amount,
            'participant_count' => $registration->participant_count,
        ], 201);
    }
}
