<?php

namespace App\Http\Requests;

use App\Models\PaymentSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegistrationRequest extends FormRequest
{
    public const STANDARD_RATE = 15000;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'p_name' => ['required', 'string', 'max:255'],
            'p_role' => ['required', 'string', Rule::in($this->participantRoles())],
            'p_subject' => ['nullable', 'string', 'max:255'],
            'p_years' => ['nullable', 'integer', 'min:0', 'max:60'],
            'p_phone' => ['required', 'string', 'max:30'],
            'p_email' => ['required', 'email', 'max:255'],
            'school_name' => ['required', 'string', 'max:255'],
            'school_type' => ['required', 'string', Rule::in($this->schoolTypes())],
            'county' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'tier' => ['required', Rule::in(['standard'])],
            'accessibility' => ['nullable', 'string', 'max:2000'],
            'dietary' => ['nullable', 'string', 'max:2000'],
            'payment_mode' => ['required', 'string', Rule::in($this->paymentModes())],
            'confirm_attendance' => ['accepted'],
            'consent_comms' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'p_name.required' => 'Please enter your full name.',
            'p_role.required' => 'Please select your role or designation.',
            'p_role.in' => 'Please select a valid role.',
            'p_phone.required' => 'Please enter your mobile telephone number.',
            'p_email.required' => 'Please enter your email address.',
            'p_email.email' => 'Please enter a valid email address.',
            'school_name.required' => 'Please enter the name of your school or institution.',
            'school_type.required' => 'Please select a school type.',
            'school_type.in' => 'Please select a valid school type.',
            'county.required' => 'Please enter your county or region.',
            'tier.required' => 'Please select a registration fee.',
            'payment_mode.required' => 'Please select a preferred payment method.',
            'payment_mode.in' => 'Please select a valid payment method.',
            'confirm_attendance.accepted' => 'You must confirm full three-day attendance.',
        ];
    }

    public function rateForTier(string $tier): int
    {
        return self::STANDARD_RATE;
    }

    /** @return list<string> */
    private function schoolTypes(): array
    {
        return [
            'Public Primary',
            'Public Secondary',
            'Private Primary',
            'Private Secondary',
            'Special Needs School',
            'International School',
            'Faith-based / Mission',
            'Other',
        ];
    }

    /** @return list<string> */
    private function participantRoles(): array
    {
        return [
            'Head of School',
            'Deputy Head',
            'Head of Department',
            'Special Needs Co-ordinator (SENCO)',
            'Classroom Teacher',
            'Curriculum Designer',
            'Counsellor / Therapist',
            'Other',
        ];
    }

    /** @return list<string> */
    private function paymentModes(): array
    {
        return PaymentSetting::paymentModeOptions();
    }
}
