<?php

namespace Works\Biolinkworks\Models;

use Illuminate\Database\Eloquent\Model;

class BioUser extends Model
{
    // Definir la tabla en caso de que no siga la convención de nombres
    protected $table = 'bio_users';

    // Los campos que son asignables en masa (mass-assignable)
    protected $fillable = [
        'username',
        'name',
        'surname',
        'biography',
        'photo',
        'alt',
        'background',
        'calltoaction',
        'views'
    ];

    // Definir los campos que deben ser tratados como fechas (si aplica)
    protected $casts = [
        'views' => 'integer',
    ];

    // Relación con el modelo BioLink
    public function bioLinks()
    {
        return $this->hasMany(BioLink::class);
    }

    // Relación con BioCategory (muchos a muchos)
    public function categories()
    {
        return $this->belongsToMany(BioCategory::class, 'bio_category_user');
    }
    public function subcategories()
    {
        return $this->belongsToMany(BioSubcategory::class, 'bio_subcategory_user');
    }
    

    // Relación con BioTag (muchos a muchos)
    public function tags()
    {
        return $this->belongsToMany(BioTag::class, 'bio_tag_user');
    }

    // Relación con BioTemporalText (uno a muchos)
    public function temporalTexts()
    {
        return $this->hasMany(BioTemporalText::class);
    }
}
