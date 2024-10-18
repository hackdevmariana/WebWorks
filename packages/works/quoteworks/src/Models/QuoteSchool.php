<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'links',
        'description',
        'active_stage',
    ];

    // Relación many-to-many con QuoteLinks
    public function links()
    {
        return $this->belongsToMany(QuoteLink::class, 'school_links', 'school_id', 'link_id');
    }

    // Relación many-to-many con QuoteAuthors
    // Relación many-to-many con QuoteAuthors
    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'author_schools', 'school_id', 'author_id');
    }


    // Relación many-to-many con QuoteBooks
    public function books()
    {
        return $this->belongsToMany(QuoteBook::class, 'book_schools', 'school_id', 'book_id');
    }

}
