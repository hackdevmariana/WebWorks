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

    public function candidate()
    {
        return $this->belongsTo(UserScholarships::class, 'candidate');
    }

    public function benefactor()
    {
        return $this->belongsTo(UserScholarships::class, 'benefactor');
    }

    public function typeScholarship()
    {
        return $this->belongsTo(TypeScholarship::class, 'type_scholarship');
    }

}
