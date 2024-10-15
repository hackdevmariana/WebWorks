<?php

namespace Works\Scholarshipsworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarships extends Model
{
    use HasFactory;

    protected $table = 'scholarships';

    protected $fillable = [
        'event',
        'status',
        'candidate',
        'benefactor',
        'type_scholarship',
    ];

    // Si necesitas definir relaciones, hazlo aquí
}
