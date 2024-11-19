<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'slug',
        'description',
        'url',
        'image',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
