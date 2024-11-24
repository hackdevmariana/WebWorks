<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationPattern extends Model
{
    use HasFactory;

    protected $fillable = [
        'featured_content_id',
        'pattern', 
    ];

    public function featuredContent()
    {
        return $this->belongsTo(FeaturedContent::class);
    }
}
