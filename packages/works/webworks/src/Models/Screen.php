<?php
namespace Works\Webworks\Models;


use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $fillable = ['website_id', 'screen', 'width'];

    // Relación muchos a muchos con Menu
    public function menus()
    {
        return $this->belongsToMany(CustomMenu::class);
    }
}
