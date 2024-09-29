<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialNetwork extends Model
{
    protected $fillable = [
        'website_id',
        'socialnetwork',
        'url',
    ];

    /**
     * Relación con el modelo Website.
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}
