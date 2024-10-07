<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['website_id', 'name'];

    // Relación con contenidos de tipo 'gallery_item'
    public function contents()
    {
        return $this->hasMany(Content::class)->where('content_type', 'gallery_item');
    }
}
