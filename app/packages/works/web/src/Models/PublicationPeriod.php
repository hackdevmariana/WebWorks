<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'featured_content_id',
        'start_date',
        'end_date',
    ];

    public function featuredContent()
    {
        return $this->belongsTo(FeaturedContent::class);
    }
}
