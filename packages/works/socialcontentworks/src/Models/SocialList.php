<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;

class SocialList extends Model
{
    protected $table = 'social_lists';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'contents',
        'platform',
        'privacy',
    ];

    public function tags()
    {
        return $this->belongsToMany(SocialTag::class, 'social_list_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(SocialCategory::class, 'social_list_category');
    }
}
