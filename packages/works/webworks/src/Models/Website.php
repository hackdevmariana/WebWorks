<?php

namespace Works\Webworks\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    public function logos()
    {
        return $this->belongsToMany(Logo::class);
    }
    
}


