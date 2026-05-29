<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PaymentConfirmed;
use App\Models\Registration;
use App\Models\SentEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $registrations = Registration::query()
            ->search($request->string('q')->toString())
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('tier'), fn ($q) => $q->where('tier', $request->tier))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'statuses' => Registration::STATUSES,
        ]);
    }

    public function show(Registration $registration): View
    {
        $registration->load('participants');

        return view('admin.registrations.show', [
            'registration' => $registration,
            'statuses' => Registration::STATUSES,
            'defaultPaymentMessage' => $this->defaultPaymentConfirmationMessage($registration),
        ]);
    }

    public function update(Request $request, Registration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', array_keys(Registration::STATUSES))],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
            'payment_confirmation_message' => ['nullable', 'string', 'max:5000'],
            'followed_up_at' => ['nullable', 'date'],
        ]);

        $previousStatus = $registration->status;
        $newStatus = $validated['status'];

        $message = $validated['payment_confirmation_message']
            ?? $registration->payment_confirmation_message
            ?? $this->defaultPaymentConfirmationMessage($registration);

        $registration->update([
            'status' => $newStatus,
            'admin_notes' => $validated['admin_notes'] ?? null,
            'payment_confirmation_message' => $validated['payment_confirmation_message'] ?? $registration->payment_confirmation_message,
            'followed_up_at' => $validated['followed_up_at'] ?? null,
        ]);

        $flash = 'Registration updated successfully.';

        if ($previousStatus !== 'payment_received' && $newStatus === 'payment_received') {
            $sent = $this->sendPaymentConfirmation($registration->fresh('participants'), $message);

            if ($sent) {
                $registration->update([
                    'payment_confirmation_message' => $message,
                    'payment_confirmed_at' => now(),
                ]);
                $flash = 'Registration updated and payment confirmation email sent to all applicants.';
            } else {
                $flash = 'Registration updated, but the payment confirmation email could not be sent. Check the logs.';
            }
        }

        return redirect()
            ->route('admin.registrations.show', $registration)
            ->with('success', $flash);
    }

    private function defaultPaymentConfirmationMessage(Registration $registration): string
    {
        return "We confirm receipt of your payment of KShs. ".number_format($registration->total_amount)." for the Inclusive by Design Masterclass (reference {$registration->reference}).\n\n".
            "Your team's places are now secured for 14 – 16 July 2026 at Maison Ubuntu Training & Conference Centre, Dagoretti. We will share any pre-event logistics closer to the date.\n\n".
            'Thank you for your commitment to building future-ready, inclusive classrooms.';
    }

    private function sendPaymentConfirmation(Registration $registration, string $message): bool
    {
        $recipients = collect([$registration->lead_email, $registration->school_email])
            ->merge($registration->participants->pluck('email'))
            ->filter()
            ->map(fn (string $email) => strtolower(trim($email)))
            ->unique()
            ->values();

        if ($recipients->isEmpty()) {
            return false;
        }

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

            $mail->send(new PaymentConfirmed($registration, $message));

            SentEmail::create([
                'registration_id' => $registration->id,
                'type' => 'payment_confirmed',
                'subject' => 'Payment Confirmed — Inclusive by Design ('.$registration->reference.')',
                'recipients' => $recipients->implode(', '),
                'status' => SentEmail::STATUS_SUCCESS,
                'sent_at' => now(),
            ]);

            return true;
        } catch (\Throwable $e) {
            SentEmail::create([
                'registration_id' => $registration->id,
                'type' => 'payment_confirmed',
                'subject' => 'Payment Confirmed — Inclusive by Design ('.$registration->reference.')',
                'recipients' => $recipients->implode(', '),
                'status' => SentEmail::STATUS_FAILED,
                'failure_reason' => $e->getMessage(),
            ]);

            Log::error('Payment confirmation email failed', [
                'reference' => $registration->reference,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
