<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    // Atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'event_id',
        'name',
        'slug',
        'description',
        'start',
        'end',
        'category',
        'payment_gateway',
    ];

    // Relación con el modelo Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
