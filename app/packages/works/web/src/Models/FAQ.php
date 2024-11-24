<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $table = 'faqs';

    protected $fillable = [
        'web_id',
        'name',
        'slug',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }


    public function questions()
    {
        return $this->hasMany(QuestionAnswer::class, 'faq_id');
    }
}
