<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionHeading extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'name', 'title', 'h', 'class'];

    /**
     * Relación con el modelo Website.
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
