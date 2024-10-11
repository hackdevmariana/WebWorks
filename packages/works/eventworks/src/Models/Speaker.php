<?php

namespace Works\Eventworks\Models;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = ['name', 'surname', 'slug', 'biography', 'books'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function links()
    {
        return $this->belongsToMany(Link::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }
}
