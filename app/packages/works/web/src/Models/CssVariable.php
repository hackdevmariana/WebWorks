<?php

namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CssVariable extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value'];
    protected static function booted()
    {
        static::saved(function () {
            cache()->forget('css.variables');
        });

        static::deleted(function () {
            cache()->forget('css.variables');
        });
    }
    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}

