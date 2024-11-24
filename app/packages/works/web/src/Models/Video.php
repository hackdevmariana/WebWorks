<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'title',
        'slug',
        'subtitle',
        'description',
        'author',
        'url',
        'youtube_id',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
    // En el modelo Video
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class)
            ->withPivot('order');
    }

}
