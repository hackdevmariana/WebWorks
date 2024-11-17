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

        if (!is_array($decoded)) {
            return [];
        }

        // Retornar como un array con 'key' y 'value' si el dato es asociativo
        if (array_is_list($decoded)) {
            return $decoded;
        }

        // Convertir formato asociativo a lista de objetos
        return collect($decoded)->map(function ($value, $key) {
            return ['key' => $key, 'value' => $value];
        })->toArray();
    }


    public function setLinksAttribute($value)
    {
        if (is_string($value)) {
            $value = json_decode($value, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->attributes['links'] = null;
                return;
            }
        }

        if (is_array($value)) {
            $formatted = [];
            foreach ($value as $item) {
                if (isset($item['key'], $item['value'])) {
                    $formatted[$item['key']] = $item['value'];
                }
            }
            $this->attributes['links'] = json_encode($formatted);
        } else {
            $this->attributes['links'] = null;
        }
    }
    protected $casts = [
        'links' => 'array',
    ];
    
}
