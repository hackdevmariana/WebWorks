<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Model;

class CssVariable extends Model
{
    protected $fillable = ['key', 'value', 'keywords', 'web_id', 'type'];


    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->key) && !empty($model->keywords)) {
                $model->key = '--' . str_replace(' ', '-', strtolower(trim($model->keywords)));
            }
        });

        static::saved(function ($model) {
            if (str_ends_with($model->key, '-rgb')) {
                return;
            }

            $keyRgb = $model->key . '-rgb';
            $valueRgb = self::hexToRgb($model->value);

            CssVariable::updateOrCreate(
                ['key' => $keyRgb, 'web_id' => $model->web_id],
                [
                    'value' => $valueRgb,
                    'keywords' => $model->keywords,
                    'type' => 'color',
                ]
            );
        });
    }


    public static function hexToRgb(string $hex): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) === 3) {
            $hex = preg_replace('/(.)/', '$1$1', $hex);
        }
        $rgb = sscanf($hex, "%02x%02x%02x");
        return implode(', ', $rgb);
    }
}







