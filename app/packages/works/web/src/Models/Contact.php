<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_id',
        'name',
        'slug',
        'title',
        'phone',
        'email',
        'address',
        'city',
        'country',
        'other',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class, 'web_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($contact) {
            if (!$contact->slug) {
                $contact->slug = \Str::slug($contact->name);
            }
        });
    }
}
