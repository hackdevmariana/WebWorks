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

    // Relación de pertenencia con Cycle
    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    // Relación de pertenencia con Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relación de pertenencia con Organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    // Relación de pertenencia con Speaker
    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    // Relación de pertenencia con Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}