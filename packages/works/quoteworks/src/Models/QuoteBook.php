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

    // Relación many-to-many con QuoteSchools
    public function schools()
    {
        return $this->belongsToMany(QuoteSchool::class, 'book_schools', 'book_id', 'school_id');
    }

 
    public function collections() 
    { 
        return $this->belongsToMany(QuoteCollection::class); 
    }
    
    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'quote_author_quote_books');
    }
    
    public function media() 
    { 
        return $this->belongsToMany(QuoteMedia::class); 
    }
}
