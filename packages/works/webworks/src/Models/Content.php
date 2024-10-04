<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;
use Works\Webworks\Models\Author;
use Works\Webworks\Models\PublicationPeriod;

class Content extends Model
{
    protected $fillable = [
        'website_id', 'name', 'title', 'subtitle', 'text', 'image', 'url', 
        'alt', 'content_type', 'is_default', 'draft', 'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publicationPeriod()
    {
        return $this->hasOne(PublicationPeriod::class);
    }
}
