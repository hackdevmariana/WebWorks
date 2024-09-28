<?php
namespace Works\Webworks\Models;


use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['website_id', 'text', 'url', 'icon'];

    // Relación muchos a muchos con Menu
    public function menus()
    {
        return $this->belongsToMany(CustomMenu::class)
                    ->withPivot('order')
                    ->orderBy('pivot_order');
    }
}
