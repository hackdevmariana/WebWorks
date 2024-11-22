<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'title',
        'slug',
        'question',
        'answer',
        'category',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
