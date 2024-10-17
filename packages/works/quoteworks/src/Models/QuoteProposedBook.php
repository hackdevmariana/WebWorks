<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteProposedBook extends Model
{
    protected $fillable = [
        'title_in_spanish',
        'slug',
        'original_title',
        'original_language',
        'author',
        'translator',
        'publisher',
        'number_of_pages',
        'publication_date',
        'weight',
        'dimensions',
        'links',
        'media',
        'isbn',
        'category',
        'synopsis',
        'notes',
    ];
}
