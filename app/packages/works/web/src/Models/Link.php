<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'text',
        'slug',
        'url',
        'icon',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class, 'web_id');
    }
    
}
