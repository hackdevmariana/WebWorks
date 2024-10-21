<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    // Tabla asociada al modelo (opcional si la convención de nombre es correcta)
    protected $table = 'social_users';

    // Los atributos que se pueden asignar en masa
    protected $fillable = [
        'username',
        'name',
        'surname',
        'biography',
        'photo',
    ];

    // Cast del campo 'photo' a string (si es una URL o ruta)
    protected $casts = [
        'photo' => 'string',
    ];

    // Relaciones, funciones adicionales u otras propiedades pueden añadirse aquí
}
