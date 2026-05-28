<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreRegistrationRequest extends FormRequest
{
    public const STANDARD_RATE = 25000;

    public const EARLYBIRD_RATE = 20000;

    public const EARLYBIRD_MIN = 3;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'school_name' => ['required', 'string', 'max:255'],
            'school_type' => ['required', 'string', Rule::in($this->schoolTypes())],
            'county' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'school_phone' => ['required', 'string', 'max:30'],
            'school_email' => ['required', 'email', 'max:255'],
            'lead_name' => ['required', 'string', 'max:255'],
            'lead_role' => ['required', 'string', 'max:255'],
            'lead_phone' => ['required', 'string', 'max:30'],
            'lead_email' => ['required', 'email', 'max:255'],
            'tier' => ['required', Rule::in(['standard', 'earlybird'])],
            'participants' => ['required', 'array', 'min:1', 'max:50'],
            'participants.*.name' => ['required', 'string', 'max:255'],
            'participants.*.role' => ['required', 'string', Rule::in($this->participantRoles())],
            'participants.*.subject' => ['nullable', 'string', 'max:255'],
            'participants.*.years' => ['nullable', 'integer', 'min:0', 'max:60'],
            'participants.*.phone' => ['required', 'string', 'max:30'],
            'participants.*.email' => ['required', 'email', 'max:255'],
            'accessibility' => ['nullable', 'string', 'max:2000'],
            'dietary' => ['nullable', 'string', 'max:2000'],
            'payment_mode' => ['required', 'string', Rule::in($this->paymentModes())],
            'confirm_authority' => ['accepted'],
            'confirm_attendance' => ['accepted'],
            'consent_comms' => ['sometimes', 'boolean'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $participants = $this->input('participants', []);
            $count = is_array($participants) ? count($participants) : 0;
            $tier = $this->input('tier');
            $eligible = $count >= self::EARLYBIRD_MIN;

            if ($eligible && $tier !== 'earlybird') {
                $validator->errors()->add('tier', 'Teams of three or more must use the School-Team Early Bird tier.');
            }

            if (! $eligible && $tier !== 'standard') {
                $validator->errors()->add('tier', 'Fewer than three participants must use Standard Registration.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'school_name.required' => 'Please enter the name of your school.',
            'school_type.required' => 'Please select a school type.',
            'school_type.in' => 'Please select a valid school type.',
            'county.required' => 'Please enter your county or region.',
            'school_phone.required' => 'Please enter the school telephone number.',
            'school_email.required' => 'Please enter the official school email.',
            'school_email.email' => 'Please enter a valid school email address.',
            'lead_name.required' => 'Please enter the lead contact name.',
            'lead_role.required' => 'Please enter the lead contact role.',
            'lead_phone.required' => 'Please enter the lead contact mobile number.',
            'lead_email.required' => 'Please enter the lead contact email.',
            'lead_email.email' => 'Please enter a valid lead contact email.',
            'tier.required' => 'Please select a registration tier.',
            'participants.required' => 'Please add at least one participant.',
            'participants.min' => 'Please add at least one participant.',
            'participants.*.name.required' => 'Each participant must have a full name.',
            'participants.*.role.required' => 'Each participant must have a role.',
            'participants.*.role.in' => 'Please select a valid role for each participant.',
            'participants.*.phone.required' => 'Each participant must have a mobile number.',
            'participants.*.email.required' => 'Each participant must have an email address.',
            'participants.*.email.email' => 'Please enter a valid email for each participant.',
            'payment_mode.required' => 'Please select a preferred payment method.',
            'payment_mode.in' => 'Please select a valid payment method.',
            'confirm_authority.accepted' => 'You must confirm you are authorised to register on behalf of your school.',
            'confirm_attendance.accepted' => 'You must confirm full three-day attendance.',
        ];
    }

    public function rateForTier(string $tier): int
    {
        return $tier === 'earlybird' ? self::EARLYBIRD_RATE : self::STANDARD_RATE;
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
        return [
            'KCB Bank Account — Africa Special Needs Education Network (1319601561)',
            'M-Pesa Paybill (522533)',
            'Cheque — Africa Special Needs Education Network',
        ];
    }
}
