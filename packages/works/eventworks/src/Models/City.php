<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class City extends Model
{
    protected $fillable = ['name', 'slug', 'country_id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name); 
        });
    }

    // Relación: Una ciudad pertenece a un país
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'city_participant');
    }


    // Relación: Muchas a muchas con Event
    public function events()
    {
        return $this->belongsToMany(Event::class, 'city_event');
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'city_organizer');
    }
    
}
