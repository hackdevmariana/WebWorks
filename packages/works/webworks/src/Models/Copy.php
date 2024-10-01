<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Copy extends Model
{
    protected $fillable = [
        'website_id', 'name', 'copy', 'license', 'author', 'url', 'text', 'subtext'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
