<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quote) {
            $quote->slug = Str::slug(Str::limit($quote->quote, 50));
        });
    }
    public function author()
    {
        return $this->belongsTo(QuoteAuthor::class, 'author_id')->withDefault(['name' => 'Unknown']); 
    }
    
    public function book()
    {
        return $this->belongsTo(QuoteBook::class, 'id_book')->withDefault(['title_in_spanish' => 'Unknown']);
    }
    
    public function link()
    {
        return $this->belongsTo(QuoteLink::class, 'id_link')->withDefault(['url' => null]); 
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
