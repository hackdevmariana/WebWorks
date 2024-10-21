<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $table = 'social_accounts';

    protected $fillable = [
        'real_name',
        'username',
        'platform',
        'link',
    ];

    public function tags()
    {
        return $this->belongsToMany(SocialTag::class, 'social_account_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(SocialCategory::class, 'social_account_category');
    }
}
