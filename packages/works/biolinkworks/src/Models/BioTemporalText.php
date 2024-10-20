<?php

namespace Works\Biolinkworks\Models;

use Illuminate\Database\Eloquent\Model;

class BioTemporalText extends Model
{
    // Define los campos que pueden ser asignados en masa
    protected $fillable = ['name', 'slug', 'title', 'text', 'start', 'end', 'bio_user_id'];

    // Relación de pertenencia a BioUser
    public function bioUser()
    {
        return $this->belongsTo(BioUser::class, 'bio_user_id');
    }
}
