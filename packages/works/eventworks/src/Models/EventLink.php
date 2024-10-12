<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class EventLink extends Model
{
    protected $fillable = ['name', 'slug', 'url', 'alt'];

    protected static function boot()
    {
        parent::boot();

        // Generar automáticamente el slug basado en el nombre
        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function organizers()
    {
        return $this->belongsToMany(Organizer::class, 'organizer_link');
    }


    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_link');
    }

}