<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'name',
        'slug',
        'description',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'gallery_content')->withTimestamps();
    }
}
