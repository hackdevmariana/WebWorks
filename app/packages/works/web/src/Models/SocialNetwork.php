<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'title',
        'slug',
        'description',
        'socialnetwork',
        'url',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
