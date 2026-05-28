<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Mail\RegistrationReceived;
use App\Models\PaymentSetting;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function show(string $reference): View
    {
        $registration = Registration::with('participants')
            ->where('reference', $reference)
            ->firstOrFail();

        $tierLabel = $registration->tier === 'earlybird'
            ? 'School-Team Early Bird'
            : 'Standard Registration';

        $paybillOption = PaymentSetting::get('option_paybill', '');
        $isPaybill = $paybillOption && str_contains($registration->payment_mode, $paybillOption);
        $paymentDetails = [
            'paybill_number' => PaymentSetting::get('paybill_number', '522533'),
            'paybill_account' => PaymentSetting::get('paybill_account_number', '1319601561'),
            'kcb_name' => PaymentSetting::get('kcb_account_name'),
            'kcb_number' => PaymentSetting::get('kcb_account_number'),
            'cheque_payee' => PaymentSetting::get('cheque_payee'),
        ];

        return view('thank-you', compact('registration', 'tierLabel', 'isPaybill', 'paymentDetails'));
    }

    public function store(StoreRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $participants = $validated['participants'];
        $count = count($participants);
        $rate = $request->rateForTier($validated['tier']);
        $reference = 'IBD-'.strtoupper(Str::random(6));

        $registration = DB::transaction(function () use ($validated, $participants, $count, $rate, $reference) {
            $registration = Registration::create([
                'reference' => $reference,
                'school_name' => $validated['school_name'],
                'school_type' => $validated['school_type'],
                'county' => $validated['county'],
                'address' => $validated['address'] ?? null,
                'school_phone' => $validated['school_phone'],
                'school_email' => $validated['school_email'],
                'lead_name' => $validated['lead_name'],
                'lead_role' => $validated['lead_role'],
                'lead_phone' => $validated['lead_phone'],
                'lead_email' => $validated['lead_email'],
                'tier' => $validated['tier'],
                'participant_count' => $count,
                'rate_per_participant' => $rate,
                'total_amount' => $rate * $count,
                'accessibility' => $validated['accessibility'] ?? null,
                'dietary' => $validated['dietary'] ?? null,
                'payment_mode' => $validated['payment_mode'],
                'confirm_authority' => true,
                'confirm_attendance' => true,
                'consent_comms' => (bool) ($validated['consent_comms'] ?? false),
                'status' => 'pending',
            ]);

            foreach ($participants as $index => $participant) {
                $registration->participants()->create([
                    'position' => $index + 1,
                    'name' => $participant['name'],
                    'role' => $participant['role'],
                    'subject' => $participant['subject'] ?? null,
                    'years' => isset($participant['years']) && $participant['years'] !== ''
                        ? (int) $participant['years']
                        : null,
                    'phone' => $participant['phone'],
                    'email' => $participant['email'],
                ]);
            }

            return $registration->load('participants');
        });

        $this->sendRegistrationConfirmation($registration);

        return response()->json([
            'message' => 'Registration submitted successfully.',
            'reference' => $registration->reference,
            'redirect_url' => route('registrations.thank-you', $registration->reference),
            'total' => $registration->total_amount,
            'participant_count' => $registration->participant_count,
        ], 201);
    }

    private function sendRegistrationConfirmation(Registration $registration): void
    {
        try {
            $mail = Mail::to($registration->lead_email);

            if ($registration->school_email !== $registration->lead_email) {
                $mail->cc($registration->school_email);
            }

            $secretariat = config('mail.secretariat.address');
            if ($secretariat) {
                $mail->bcc($secretariat);
            }

            $mail->send(new RegistrationReceived($registration));
        } catch (\Throwable $e) {
            Log::error('Registration confirmation email failed', [
                'reference' => $registration->reference,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
