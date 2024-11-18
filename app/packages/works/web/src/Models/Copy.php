<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'author_id',
        'name',
        'slug',
        'title',
        'subtitle',
        'text',
        'subtext',
        'copy',
        'license',
        'url',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class, 'web_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
