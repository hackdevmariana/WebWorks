<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'start',
        'end',
        'pattern',
        'days',
        'links',
        'media',
        'tag',
        'frequency'
    ];

    // Relación uno a muchos con Event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
