<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'slug', 'country_id'];

    // Relación: Una ciudad pertenece a un país
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relación: Muchas a muchas con Participant
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    // Relación: Muchas a muchas con Event
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    // Relación: Muchas a muchas con Organizer
    public function organizers()
    {
        return $this->belongsToMany(Organizer::class);
    }
}
