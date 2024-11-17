<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
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
        'author_id',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
}
