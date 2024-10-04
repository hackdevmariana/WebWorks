<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;
use Works\Webworks\Models\PublicationPattern;

class PublicationPeriod extends Model
{
    protected $fillable = ['website_id', 'content_id', 'start_day', 'end_day'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function publicationPattern()
    {
        return $this->hasOne(PublicationPattern::class);
    }
}
