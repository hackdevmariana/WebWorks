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
        return $this->belongsToMany(QuoteAuthor::class, 'quote_author_quote_media', 'quote_media_id', 'quote_author_id');
    }


    public function books()
    {
        return $this->belongsToMany(QuoteBook::class, 'book_media', 'media_id', 'book_id');
    }
}
