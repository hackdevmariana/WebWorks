<?php 

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'website_id',
        'name',
        'slug',
        'title',
        'subtitle',
        'text',
        'image',
        'url',
        'alt',
        'content_type',
        'is_default',
        'draft',
        'author_id'
    ];

    // Relación con el autor (si es necesario)
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relación con el periodo de publicación (si es necesario)
    public function publicationPeriod()
    {
        return $this->hasOne(PublicationPeriod::class);
    }

    // Relación con carruseles
    public function carousels()
    {
        return $this->belongsToMany(Carousel::class, 'carousel_content', 'content_id', 'carousel_id');
    }

    // Relación con ítems del carrusel
    public function carouselItems()
    {
        return $this->belongsToMany(Content::class, 'carousel_content', 'carousel_id', 'content_id');
    }

    // Relación con galerías
    public function galleries()
    {
        return $this->belongsToMany(Gallery::class, 'content_gallery');
    }

    // Relación con ítems de la galería
    public function galleryItems()
    {
        return $this->belongsToMany(Content::class, 'content_gallery', 'gallery_id', 'content_id');
        
    }
}
