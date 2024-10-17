<?php

namespace Works\Scholarshipsworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipsFollowUp extends Model
{
    use HasFactory;

    protected $table = 'scholarships_follow_ups';

    protected $fillable = [
        'title',
        'abstract',
        'text',
        'link',
        'comments',
        'status',
    ];
}
