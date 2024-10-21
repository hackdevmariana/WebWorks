<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;

class SocialContent extends Model
{
    protected $table = 'social_contents';

    protected $fillable = [
        'description',
        'platform',
        'url',
        'date',
    ];

    public function tags()
    {
        return $this->belongsToMany(SocialTag::class, 'social_content_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(SocialCategory::class, 'social_content_category');
    }
}
