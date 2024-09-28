<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'name',
    ];

    // Define la relación con la tabla websites si es necesario
    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    // Relación con el modelo Link
    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
