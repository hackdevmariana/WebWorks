<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'transmitter',
        'receiver',
        'thread',
        'text',
    ];

    // Relación con un emisor (transmitter)
    public function transmitterUser(): BelongsTo
    {
        return $this->belongsTo(EventUser::class, 'transmitter');
    }

    // Relación con un receptor (receiver)
    public function receiverUser(): BelongsTo
    {
        return $this->belongsTo(EventUser::class, 'receiver');
    }
}
