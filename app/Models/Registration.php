<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    protected $fillable = [
        'reference',
        'school_name',
        'school_type',
        'county',
        'address',
        'school_phone',
        'school_email',
        'lead_name',
        'lead_role',
        'lead_phone',
        'lead_email',
        'tier',
        'participant_count',
        'rate_per_participant',
        'total_amount',
        'accessibility',
        'dietary',
        'payment_mode',
        'confirm_authority',
        'confirm_attendance',
        'consent_comms',
    ];

    protected function casts(): array
    {
        return [
            'confirm_authority' => 'boolean',
            'confirm_attendance' => 'boolean',
            'consent_comms' => 'boolean',
        ];
    }

    public function participants(): HasMany
    {
        return $this->hasMany(RegistrationParticipant::class);
    }
}
