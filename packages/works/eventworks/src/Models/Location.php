<?php
namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name', 'slug', 'address', 'city_id', 'country_id', 'zip', 'phone'
    ];

    // Relación con City: Una ubicación pertenece a una ciudad
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relación con Country: Una ubicación pertenece a un país
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relación muchos a muchos con Event
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_location');
    }

    // Relación muchos a muchos con Link
    public function links()
    {
        return $this->belongsToMany(Link::class, 'location_link');
    }

    // Relación muchos a muchos con Media
    public function media()
    {
        return $this->belongsToMany(Media::class, 'location_media');
    }
}
