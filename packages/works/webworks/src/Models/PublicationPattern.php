<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class PublicationPattern extends Model
{
    protected $fillable = [
        'website_id', 'pattern_name', 'day_of_the_week', 'day_of_the_month', 'specific_day', 'type'
    ];

    public function publicationPeriod()
    {
        return $this->belongsTo(PublicationPeriod::class);
    }
}
