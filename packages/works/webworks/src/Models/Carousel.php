<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $fillable = ['website_id', 'name'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'carousel_content', 'carousel_id', 'content_id');
    }
}

