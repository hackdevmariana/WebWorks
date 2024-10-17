<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'related_fields',
    ];

    public function quoteLinks()
    {
        return $this->belongsToMany(QuoteLink::class, 'quote_category_quote');
    }

    public function quoteSchools()
    {
        return $this->belongsToMany(QuoteSchool::class, 'quote_category_quote');
    }

    public function quoteQuotes()
    {
        return $this->belongsToMany(QuoteQuote::class, 'quote_category_quote');
    }

    public function quoteAuthors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'quote_category_quote');
    }

    public function quoteBooks()
    {
        return $this->belongsToMany(QuoteBook::class, 'quote_category_quote');
    }
}
