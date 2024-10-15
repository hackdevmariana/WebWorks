<?php

namespace Works\Scholarshipsworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeScholarship extends Model
{
    use HasFactory;

    protected $table = 'type_scholarships';

    protected $fillable = [
        'event',
        'name',
        'price',
        'place_of_origin',
        'books_to_buy',
        'id_user_candidate',   
        'id_user_benefactor',  
    ];

    protected $casts = [
        'books_to_buy' => 'json',
    ];
}
