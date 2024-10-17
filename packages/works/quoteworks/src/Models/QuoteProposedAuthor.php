<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteProposedAuthor extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'slug',
        'media',
        'areas_of_study',
        'school',
        'collaborations',
        'urls',
        'date_of_birth',
        'date_of_death',
        'place_of_birth',
        'place_of_death',
        'biography',
        'published_books',
        'links_to_articles',
        'author_slug',
    ];
}
