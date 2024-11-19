<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'slug',
        'description',
        'text',
        'h',
        'class',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
