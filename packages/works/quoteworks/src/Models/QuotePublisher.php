<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotePublisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'address',
        'phone',
    ];

    // Relación many-to-many con QuoteLinks
    public function links()
    {
        return $this->belongsToMany(QuoteLink::class, 'publisher_links', 'publisher_id', 'link_id');
    }

    // Relación many-to-many con QuoteAuthors
    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'author_publishers', 'publisher_id', 'author_id');
    }

    // Relación many-to-many con QuoteBooks
    public function books()
    {
        return $this->belongsToMany(QuoteBook::class, 'book_publishers', 'publisher_id', 'book_id');
    }
}
