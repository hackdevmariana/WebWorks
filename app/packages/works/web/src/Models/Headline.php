<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Headline extends Model
{
    use HasFactory;
    use HasTranslations;

    


    protected $fillable = [
        'web_id',
        'slug',
        'description',
        'text',
        'h',
        'class',
    ];

    // public $translatable = ['description', 'text', 'h', 'class'];
    public $translatable = [];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
