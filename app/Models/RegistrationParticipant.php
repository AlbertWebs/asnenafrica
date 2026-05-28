<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationParticipant extends Model
{
    protected $fillable = [
        'registration_id',
        'position',
        'name',
        'role',
        'subject',
        'years',
        'phone',
        'email',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
