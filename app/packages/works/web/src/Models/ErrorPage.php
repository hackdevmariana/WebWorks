<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'error_number',
        'title',
        'subtitle',
        'text',
        'image',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class, 'web_id');
    }
}
