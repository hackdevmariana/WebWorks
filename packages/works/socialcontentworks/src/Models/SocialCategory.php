<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SocialCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Set the slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }

    /**
     * The social accounts that belong to the category.
     *
     * @return BelongsToMany
     */
    public function socialAccounts(): BelongsToMany
    {
        return $this->belongsToMany(SocialAccount::class, 'social_account_category', 'category_id', 'account_id');
    }

    /**
     * The social content that belong to the category.
     *
     * @return BelongsToMany
     */
    public function socialContent(): BelongsToMany
    {
        return $this->belongsToMany(SocialContent::class, 'social_content_category', 'category_id', 'content_id');
    }

    /**
     * The social lists that belong to the category.
     *
     * @return BelongsToMany
     */
    public function socialLists(): BelongsToMany
    {
        return $this->belongsToMany(SocialList::class, 'social_list_category', 'category_id', 'list_id');
    }
}
