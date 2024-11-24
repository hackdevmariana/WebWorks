<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function publicationPattern()
    {
        return $this->hasOne(PublicationPattern::class);
    }

    public function publicationPeriod()
    {
        return $this->hasOne(PublicationPeriod::class);
    }
}
