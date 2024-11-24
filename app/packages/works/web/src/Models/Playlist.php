<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
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

    public function videos()
    {
        return $this->belongsToMany(Video::class)
            ->withPivot('order');
    }
}
