<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegistrationRequest;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function show(string $reference): View
    {
        $registration = Registration::where('reference', $reference)->firstOrFail();

        $tierLabel = $registration->tier === 'earlybird'
            ? 'School-Team Early Bird'
            : 'Standard Registration';

        return view('thank-you', compact('registration', 'tierLabel'));
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

            return $registration;
        });

        return response()->json([
            'message' => 'Registration submitted successfully.',
            'reference' => $registration->reference,
            'redirect_url' => route('registrations.thank-you', $registration->reference),
            'total' => $registration->total_amount,
            'participant_count' => $registration->participant_count,
        ], 201);
    }
}
