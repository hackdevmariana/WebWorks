<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;
use Works\Webworks\Models\Content;

class Carousel extends Model
{
    protected $fillable = ['website_id', 'name'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'carousel_content', 'carousel_id', 'content_id');
    }

    // Agregar la relación de ítems del carrusel
    public function carouselItems()
    {
        return $this->contents(); // Esencialmente la misma relación de 'contents'
    }
}
