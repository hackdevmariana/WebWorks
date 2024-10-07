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

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publicationPeriod()
    {
        return $this->hasOne(PublicationPeriod::class);
    }

    public function carousels()
    {
        return $this->belongsToMany(Carousel::class, 'carousel_content', 'content_id', 'carousel_id');
    }

    // Esta relación es suficiente para obtener los items del carrusel
    public function carouselItems()
    {
        return $this->belongsToMany(Content::class, 'carousel_content', 'carousel_id', 'content_id');
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
