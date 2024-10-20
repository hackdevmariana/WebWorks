<?php

namespace Works\Biolinkworks\Models;

use Illuminate\Database\Eloquent\Model;

class BioLink extends Model
{
    // Define los campos que pueden ser asignados en masa
    protected $fillable = ['text', 'url', 'name', 'slug', 'description', 'bio_user_id'];

    // Relación de pertenencia a BioUser
    public function bioUser()
    {
        return $this->belongsTo(BioUser::class, 'bio_user_id');
    }
}
