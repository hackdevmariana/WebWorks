<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['website_id', 'name', 'title', 'subtitle', 'author', 'url'];

    // Define the relationship to the Website model
    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }
}
