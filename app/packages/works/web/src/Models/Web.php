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
        return $this->hasMany(Logo::class);
    }
    public function links()
    {
        return $this->hasMany(Link::class, 'web_id');
    }
    public function headlines()
    {
        return $this->hasMany(Headline::class, 'web_id');
    }

    public function socialnetworks()
    {
        return $this->hasMany(SocialNetwork::class, 'web_id');
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

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'web_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'web_id');
    }
    public function copies()
    {
        return $this->hasMany(Copy::class, 'web_id');
    }
    public function developeds()
    {
        return $this->hasMany(Developed::class, 'web_id');
    }

}
