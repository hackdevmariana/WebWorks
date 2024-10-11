<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preregistration extends Model
{
    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'name',
        'surname',
        'slug',
        'email',
        'mode',
        'status',
        'event_id', 
    ];

    // Relación con el modelo Event
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
