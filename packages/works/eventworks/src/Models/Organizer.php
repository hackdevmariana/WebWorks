<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $fillable = ['name', 'slug', 'phone', 'email'];

    // Relación Muchos a Muchos con Tag
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // Relación Muchos a Muchos con City
    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

    // Relación Muchos a Muchos con Category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Relación Muchos a Muchos con Event
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    // Relación Muchos a Muchos con Link
    public function links()
    {
        return $this->belongsToMany(Link::class);
    }

    // Relación Muchos a Muchos con Media
    public function media()
    {
        return $this->belongsToMany(Media::class);
    }
}
