<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'days', 'time', 'price', 'organizer_id',
        'links', 'weather', 'capacity', 'tags', 'status', 'type', 'virtual', 'cycle_id'
    ];

    // Relación opcional con Cycle
    public function cycle()
    {
        return $this->belongsTo(Cycle::class)->nullable();
    }

    // Relación opcional con Program
    public function program()
    {
        return $this->hasOne(Program::class);
    }

    // Relación uno a muchos con Organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    // Muchos a muchos con Location
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function attendances()

    {
        return $this->hasMany(Attendance::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}

