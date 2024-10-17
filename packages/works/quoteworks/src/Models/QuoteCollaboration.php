<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteCollaboration extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_collaboration',
        'description',
        'year',
    ];

    public function authors()
    {
        return $this->belongsToMany(QuoteAuthor::class, 'quote_author_quote_collaboration');
    }
}
