<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SocialTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_tags';

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
     * The social accounts that belong to the tag.
     *
     * @return BelongsToMany
     */
    public function socialAccounts(): BelongsToMany
    {
        return $this->belongsToMany(SocialAccount::class, 'social_account_tag', 'tag_id', 'account_id');
    }

    /**
     * The social content that belongs to the tag.
     *
     * @return BelongsToMany
     */
    public function socialContent(): BelongsToMany
    {
        return $this->belongsToMany(SocialContent::class, 'social_content_tag', 'tag_id', 'content_id');
    }

    /**
     * The social lists that belong to the tag.
     *
     * @return BelongsToMany
     */
    public function socialLists(): BelongsToMany
    {
        return $this->belongsToMany(SocialList::class, 'social_list_tag', 'tag_id', 'list_id');
    }
}
