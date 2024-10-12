<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'days',
        'time',
        'price',
        'organizer_id',
        'links',
        'weather',
        'capacity',
        'tags',
        'status',
        'type',
        'virtual',
        'cycle_id'
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class)->nullable();
    }

    public function tags()
    {
        return $this->belongsToMany(EventTag::class, 'event_tag_event');
    }


    public function program()
    {
        return $this->hasOne(Program::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'event_location');
    }


    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_event');
    }

    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category_event');
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participant');
    }
    
}

