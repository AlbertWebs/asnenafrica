<?php

namespace App\Services;

use App\Mail\PaymentConfirmed;
use App\Mail\PaymentConfirmedParticipant;
use App\Mail\RegistrationReceived;
use App\Mail\RegistrationReceivedParticipant;
use App\Models\Registration;
use App\Models\RegistrationParticipant;
use App\Models\SentEmail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegistrationEmailService
{
    public function sendRegistrationReceived(Registration $registration): void
    {
        $registration->loadMissing('participants');

        $concerned = $this->concernedPartyEmails($registration);
        if ($concerned->isNotEmpty()) {
            $this->sendConcernedPartyMail(
                $registration,
                $concerned,
                new RegistrationReceived($registration),
                'registration_received',
                'Registration Received — Inclusive by Design ('.$registration->reference.')',
            );
        }

        $participants = $this->participantsExcludingEmails($registration, $concerned);
        if ($participants->isEmpty()) {
            return;
        }

        $sentTo = [];

        foreach ($participants as $participant) {
            try {
                Mail::to($participant->email)->send(
                    new RegistrationReceivedParticipant($registration, $participant)
                );
                $sentTo[] = $participant->email;
            } catch (\Throwable $e) {
                $this->logFailed(
                    $registration,
                    'registration_received_participant',
                    'Registration Received — Inclusive by Design ('.$registration->reference.')',
                    $participant->email,
                    $e->getMessage(),
                );
                Log::error('Registration participant email failed', [
                    'reference' => $registration->reference,
                    'email' => $participant->email,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        if ($sentTo !== []) {
            $this->logSuccess(
                $registration,
                'registration_received_participant',
                'Registration Received — Inclusive by Design ('.$registration->reference.')',
                implode(', ', $sentTo),
            );
        }
    }

    public function sendPaymentConfirmed(Registration $registration, string $message): bool
    {
        $registration->loadMissing('participants');

        $concerned = $this->concernedPartyEmails($registration);
        $concernedSent = false;

        if ($concerned->isNotEmpty()) {
            $concernedSent = $this->sendConcernedPartyMail(
                $registration,
                $concerned,
                new PaymentConfirmed($registration, $message),
                'payment_confirmed',
                'Payment Confirmed — Inclusive by Design ('.$registration->reference.')',
            );
        }

        $participants = $this->participantsExcludingEmails($registration, $concerned);
        $participantsSent = false;

        if ($participants->isNotEmpty()) {
            $sentTo = [];

            foreach ($participants as $participant) {
                try {
                    Mail::to($participant->email)->send(
                        new PaymentConfirmedParticipant($registration, $participant)
                    );
                    $sentTo[] = $participant->email;
                } catch (\Throwable $e) {
                    $this->logFailed(
                        $registration,
                        'registration_confirmed_participant',
                        'Registration Confirmed — Inclusive by Design ('.$registration->reference.')',
                        $participant->email,
                        $e->getMessage(),
                    );
                    Log::error('Participant confirmation email failed', [
                        'reference' => $registration->reference,
                        'email' => $participant->email,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            if ($sentTo !== []) {
                $this->logSuccess(
                    $registration,
                    'registration_confirmed_participant',
                    'Registration Confirmed — Inclusive by Design ('.$registration->reference.')',
                    implode(', ', $sentTo),
                );
                $participantsSent = true;
            }
        }

        return $concernedSent || $participantsSent;
    }

    /** @return Collection<int, string> */
    private function concernedPartyEmails(Registration $registration): Collection
    {
        return collect([$registration->lead_email, $registration->school_email])
            ->filter()
            ->map(fn (string $email) => strtolower(trim($email)))
            ->unique()
            ->values();
    }

    /**
     * @param  Collection<int, string>  $excludeEmails
     * @return Collection<int, RegistrationParticipant>
     */
    private function participantsExcludingEmails(Registration $registration, Collection $excludeEmails): Collection
    {
        $seen = [];

        return $registration->participants
            ->filter(function (RegistrationParticipant $participant) use ($excludeEmails, &$seen) {
                $email = strtolower(trim($participant->email ?? ''));

                if ($email === '' || $excludeEmails->contains($email) || isset($seen[$email])) {
                    return false;
                }

                $seen[$email] = true;

                return true;
            })
            ->values();
    }

    private function sendConcernedPartyMail(
        Registration $registration,
        Collection $recipients,
        object $mailable,
        string $type,
        string $subject,
    ): bool {
        try {
            $primary = $recipients->first();
            $cc = $recipients->slice(1)->values()->all();

            $mail = Mail::to($primary);

            if ($cc !== []) {
                $mail->cc($cc);
            }

            $secretariat = config('mail.secretariat.address');
            if ($secretariat) {
                $mail->bcc($secretariat);
            }

            $mail->send($mailable);

            $this->logSuccess($registration, $type, $subject, $recipients->implode(', '));

            return true;
        } catch (\Throwable $e) {
            $this->logFailed($registration, $type, $subject, $recipients->implode(', '), $e->getMessage());
            Log::error('Concerned party email failed', [
                'reference' => $registration->reference,
                'type' => $type,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    private function logSuccess(Registration $registration, string $type, string $subject, string $recipients): void
    {
        SentEmail::create([
            'registration_id' => $registration->id,
            'type' => $type,
            'subject' => $subject,
            'recipients' => $recipients,
            'status' => SentEmail::STATUS_SUCCESS,
            'sent_at' => now(),
        ]);
    }

    private function logFailed(
        Registration $registration,
        string $type,
        string $subject,
        string $recipients,
        string $reason,
    ): void {
        SentEmail::create([
            'registration_id' => $registration->id,
            'type' => $type,
            'subject' => $subject,
            'recipients' => $recipients,
            'status' => SentEmail::STATUS_FAILED,
            'failure_reason' => $reason,
        ]);
    }
}
