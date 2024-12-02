<?php
namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Model;

class CssFont extends Model
{
    protected $fillable = ['name', 'import_url', 'variable_name'];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }
}
