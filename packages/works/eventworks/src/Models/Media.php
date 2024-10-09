<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'url', 'alt'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name); 
        });
    }

    // Relación con Cycle
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    // Relación con Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relación con Organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    // Relación con Speaker
    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    // Relación con Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
