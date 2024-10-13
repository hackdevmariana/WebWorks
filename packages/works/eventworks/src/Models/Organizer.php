<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Organizer extends Model
{
    protected $fillable = ['name', 'slug', 'phone', 'email'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name); 
        });
    }

    public function tags()
    {
        return $this->belongsToMany(EventTag::class, 'event_tag_organizer');
    }


    public function cities()
    {
        return $this->belongsToMany(City::class, 'city_organizer');
    }



    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category_organizer');
    }


    public function events()
    {
        return $this->belongsToMany(Event::class, 'organizer_event');
    }


    public function links()
    {
        return $this->belongsToMany(EventLink::class, 'organizer_link');
    }


    public function media()
    {
        return $this->belongsToMany(Media::class, 'organizer_media');
    }

}
