<?php
namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Location extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'address',
        'city_id',
        'country_id',
        'zip',
        'phone'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_location', 'location_id', 'event_id');
    }



    public function links()
    {
        return $this->belongsToMany(EventLink::class, 'location_link');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'location_media');
    }
}
