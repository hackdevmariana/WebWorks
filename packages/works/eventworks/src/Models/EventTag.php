<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class EventTag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_tag_participant');
    }


    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'event_tag_activity');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_tag_event');
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'event_tag_organizer');
    }
}
