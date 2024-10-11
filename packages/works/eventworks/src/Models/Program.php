<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['time', 'day', 'activity', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}


