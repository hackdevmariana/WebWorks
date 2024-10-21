<?php

namespace Works\Socialcontentworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialPlanet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social_planets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'accounts',
        'privacy',
        'social_user_id', // Foreign key for the relationship
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'accounts' => 'array',  // Casting the accounts field as JSON
    ];

    /**
     * The possible values for the privacy field.
     *
     * @var array
     */
    public static $privacyOptions = [
        'public',
        'private',
    ];

    /**
     * Get the SocialUser that owns the SocialPlanet.
     *
     * @return BelongsTo
     */
    public function socialUser(): BelongsTo
    {
        return $this->belongsTo(SocialUser::class);
    }

    /**
     * Set the slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = \Str::slug($value);
    }
}
