<?php

namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMenu extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'name'];

    public function links()
    {
        return $this->belongsToMany(Link::class, 'link_menu')
                    ->withPivot('order')
                    ->withTimestamps();
    }

    public function screens()
    {
        return $this->belongsToMany(Screen::class, 'menu_screen')
                    ->withTimestamps();
    }
}
