<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteProposedQuote extends Model
{
    protected $fillable = [
        'quote',
        'author',
        'book',
    ];

    // Relación con QuoteAuthor
    public function author()
    {
        return $this->belongsTo(QuoteAuthor::class, 'author');
    }

    // Relación con QuoteBook
    public function book()
    {
        return $this->belongsTo(QuoteBook::class, 'book');
    }
}
