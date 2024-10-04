<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = ['website_id', 'name'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
