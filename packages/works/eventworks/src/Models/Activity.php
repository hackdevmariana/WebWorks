<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'speaker'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'activity_speaker');
    }

    public function categories()
    {
        return $this->belongsToMany(EventCategory::class, 'event_category_activity');
    }

}
