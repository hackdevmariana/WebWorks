<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    // Definición de las relaciones Muchos a Muchos
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class);
    }
}
