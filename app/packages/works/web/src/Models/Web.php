<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'home', 'title', 'description', 'keywords', 'favicon', 'name', 'slug'];
   

    public function logos()
    {
        return $this->belongsToMany(Logo::class);
    }

    public function errorPages()
    {
        return $this->hasMany(ErrorPage::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function carousels()
    {
        return $this->hasMany(Carousel::class);
    }
    public function authors()
    {
        return $this->hasMany(Author::class, 'website_id'); 
    }
}
