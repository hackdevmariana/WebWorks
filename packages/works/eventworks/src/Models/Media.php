<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'url',
        'alt'
    ];

    protected static function boot()
    {
        parent::boot();

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
        return $this->belongsToMany(Organizer::class, 'organizer_media');
    }


    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_media');
    }

}
