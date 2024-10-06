<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;
use Works\Webworks\Models\Author;
use Works\Webworks\Models\PublicationPeriod;
use Works\Webworks\Models\Carousel;

class Content extends Model
{
    protected $fillable = [
        'website_id',
        'name',
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

    public function carouselItems()
    {
        return $this->belongsToMany(Content::class, 'carousel_content', 'carousel_id', 'content_id')
            ->where('content_type', 'carousel_item');
    }

    public function carousels()
    {
        return $this->belongsToMany(Carousel::class, 'carousel_content', 'content_id', 'carousel_id');
    }
}
