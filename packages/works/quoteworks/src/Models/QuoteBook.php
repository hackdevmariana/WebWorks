<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_in_spanish',
        'slug',
        'original_title',
        'original_language',
        'author',
        'translator',
        'publisher',
        'number_of_pages',
        'publication_date',
        'weight',
        'dimensions',
        'links',
        'media',
        'isbn',
        'category',
        'synopsis',
        'comments',
        'views',
    ];

    public function comments()
    {
        return $this->morphMany(QuoteComment::class, 'commentable');
    }
    public function reviews()
    {
        return $this->morphMany(QuoteReview::class, 'reviewable');
    }


    // Definir las relaciones cuando se agreguen los modelos correspondientes
    // public function collections() { return $this->belongsToMany(QuoteCollection::class); }
    // public function authors() { return $this->belongsToMany(QuoteAuthor::class); }
    // public function media() { return $this->belongsToMany(QuoteMedia::class); }
}
