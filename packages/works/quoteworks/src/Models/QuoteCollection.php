<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteCollection extends Model
{
    protected $fillable = ['collection', 'slug', 'description'];

    // Relación muchos a muchos con QuoteBook
    public function books()
    {
        return $this->belongsToMany(QuoteBook::class, 'quote_collection_quote_book', 'collection_id', 'book_id');
    }

    // Relación muchos a muchos con QuotePublisher
    public function publishers()
    {
        return $this->belongsToMany(QuotePublisher::class, 'quote_collection_quote_publisher', 'collection_id', 'publisher_id');
    }

    // Relación muchos a muchos con QuoteAuthor
    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'quote_collection_quote_author', 'collection_id', 'author_id');
    }
}
