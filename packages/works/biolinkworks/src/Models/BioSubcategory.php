<?php

namespace Works\Biolinkworks\Models;

use Illuminate\Database\Eloquent\Model;

class BioSubcategory extends Model
{
    // Define los campos que pueden ser asignados en masa
    protected $fillable = ['name', 'slug', 'description'];

    // Relación muchos a muchos con BioUser
    public function bioUsers()
    {
        return $this->belongsToMany(BioUser::class, 'bio_subcategory_user', 'bio_subcategory_id', 'bio_user_id');
    }
}
