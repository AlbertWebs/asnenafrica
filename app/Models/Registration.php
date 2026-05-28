<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registration extends Model
{
    public const STATUSES = [
        'pending' => 'Pending review',
        'contacted' => 'Contacted',
        'payment_received' => 'Payment received',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
    ];

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
        'status',
        'admin_notes',
        'payment_confirmation_message',
        'payment_confirmed_at',
        'followed_up_at',
    ];

    protected function casts(): array
    {
        return [
            'confirm_authority' => 'boolean',
            'confirm_attendance' => 'boolean',
            'consent_comms' => 'boolean',
            'followed_up_at' => 'datetime',
            'payment_confirmed_at' => 'datetime',
        ];
    }

    public function participants(): HasMany
    {
        return $this->hasMany(RegistrationParticipant::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('reference', 'like', "%{$term}%")
                ->orWhere('school_name', 'like', "%{$term}%")
                ->orWhere('lead_name', 'like', "%{$term}%")
                ->orWhere('lead_email', 'like', "%{$term}%")
                ->orWhere('county', 'like', "%{$term}%");
        });
    }
}
