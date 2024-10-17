<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Relación many-to-many con QuoteAuthor
    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'author_tags', 'tag_id', 'author_id');
    }

    // Relación many-to-many con QuoteBook
    public function books()
    {
        return $this->belongsToMany(QuoteBook::class, 'book_tags', 'tag_id', 'book_id');
    }
}
