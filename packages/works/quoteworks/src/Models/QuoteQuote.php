<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'views',
        'id_book',
        'id_link',
        'author_id',
    ];

    // Relación opcional con QuoteAuthor
    public function author()
    {
        return $this->belongsTo(QuoteAuthor::class, 'author_id')->withDefault(); // Con relación opcional
    }

    public function book()
    {
        return $this->belongsTo(QuoteBook::class, 'id_book')->withDefault(); // Con relación opcional
    }

    // Relación opcional con QuoteLink
    public function link()
    {
        return $this->belongsTo(QuoteLink::class, 'id_link')->withDefault(); // Con relación opcional
    }

    public function comments()
    {
        return $this->morphMany(QuoteComment::class, 'commentable');
    }
    public function reviews()
    {
        return $this->morphMany(QuoteReview::class, 'reviewable');
    }
    
}
