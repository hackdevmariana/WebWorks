<?php

namespace Works\Webworks\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    public function logos()
    {
        return $this->belongsToMany(Logo::class);
    }

    public function errorPages()
    {
        return $this->hasMany(ErrorPage::class, 'website_id');
    }
    public function videos()
    {
        return $this->hasMany(Video::class, 'website_id');
    }

    public function carousels()
    {
        return $this->hasMany(Carousel::class, 'website_id');
    }
    
}


