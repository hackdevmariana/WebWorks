<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'interests',
        'cities',
        'country_id',
    ];

    public function tags()
    {
        return $this->belongsToMany(EventTag::class, 'event_tag_participant');
    }


    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_participant');
    }


    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category_participant');
    }


    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participant');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}


