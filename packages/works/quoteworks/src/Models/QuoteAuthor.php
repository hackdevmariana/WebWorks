<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuoteAuthor extends Model
{
    protected $table = 'quote_authors';

    protected $fillable = [
        'name',
        'surname',
        'slug',
        'media',
        'areas_of_study',
        'school',
        'urls',
        'birth',
        'death',
        'biography',
        'published_books',
        'links_to_articles',
        'author_slug',
        'views'
    ];

    // Relación muchos a muchos con QuoteBook
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(QuoteBook::class, 'quote_author_quote_books', 'quote_author_id', 'quote_book_id');
    }

    // Relación muchos a muchos con QuoteMedia
    public function media(): BelongsToMany
    {
        return $this->belongsToMany(QuoteMedia::class, 'quote_author_quote_media', 'quote_author_id', 'quote_media_id');
    }
}
