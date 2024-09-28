<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





class Logo extends Model
{
    use HasFactory;
    public function websites()
    {
        return $this->belongsToMany(Website::class);
    }

}
