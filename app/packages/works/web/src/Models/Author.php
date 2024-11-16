<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Works\Web\Factories\AuthorFactory;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'username',
        'name',
        'surname',
        'links',
        'photo',
        'biography',
        'slug',
    ];

    public function website()
    {
        return $this->belongsTo(Web::class, 'website_id');
    }

    protected static function newFactory()
    {
        return AuthorFactory::new();
    }

    public function getLinksAttribute($value)
    {
        $decoded = json_decode($value, true);
        $formatted = [];

        if (is_array($decoded)) {
            foreach ($decoded as $key => $value) {
                $formatted[] = ['key' => $key, 'value' => $value];
            }
        }

        return $formatted;
    }

    public function setLinksAttribute($value)
    {
        $formatted = [];

        foreach ($value as $item) {
            $formatted[$item['key']] = $item['value'];
        }

        $this->attributes['links'] = json_encode($formatted);
    }
}
