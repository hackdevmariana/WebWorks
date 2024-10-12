<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = ['name', 'surname', 'slug', 'biography', 'books'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_speaker');
    }


    public function links()
    {
        return $this->belongsToMany(EventLink::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_speaker');
    }
}
