<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developed extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'name',
        'slug',
        'text',
        'author',
        'url',
        'technology',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class, 'web_id');
    }
}
