<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Developed extends Model
{
    protected $fillable = [
        'website_id', 
        'name', 
        'author', 
        'url', 
        'technology'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
