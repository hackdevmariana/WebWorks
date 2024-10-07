<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['website_id', 'name'];

    // Relación con contenidos de la galería
    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_gallery', 'gallery_id', 'content_id');
    }
}

