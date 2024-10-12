<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_category_participant');
    }


    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'event_category_activity');
    }


    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_category_event');
    }


    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'event_category_organizer');
    }

}
