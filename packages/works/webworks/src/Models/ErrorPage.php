<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorPage extends Model
{
    // Definir la tabla si no sigue la convención de nombres en plural
    protected $table = 'error_pages';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'website_id',
        'error_number',
        'title',
        'subtitle',
        'text',
        'image',
    ];

    /**
     * Relación: una página de error pertenece a un sitio web (Website).
     */
    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }
}
