<?php

namespace Works\Biolinkworks\Models;

use Illuminate\Database\Eloquent\Model;

class BioCategory extends Model
{
    // Define los campos que pueden ser asignados en masa
    protected $fillable = ['name', 'slug', 'description'];

    // Relación muchos a muchos con BioUser
    public function bioUsers()
    {
        return $this->belongsToMany(BioUser::class, 'bio_category_user', 'bio_category_id', 'bio_user_id');
    }
}
