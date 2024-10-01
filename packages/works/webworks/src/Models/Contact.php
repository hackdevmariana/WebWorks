<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'website_id', 
        'phone', 
        'email', 
        'address', 
        'city', 
        'country', 
        'other'
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
