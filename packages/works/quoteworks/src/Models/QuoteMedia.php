<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'url',
        'type',
    ];

    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'author_media', 'media_id', 'author_id');
    }

    public function books()
    {
        return $this->belongsToMany(QuoteBook::class, 'book_media', 'media_id', 'book_id');
    }
}
