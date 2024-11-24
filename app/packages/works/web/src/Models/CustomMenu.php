<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'name',
        'slug',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }


    public function links()
    {
        return $this->belongsToMany(Link::class);
    }
}
