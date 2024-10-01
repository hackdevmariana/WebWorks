<?php
namespace Works\Webworks\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'text', 'url', 'icon'];

    
    public function customMenus()
    {
        return $this->belongsToMany(CustomMenu::class, 'link_menu')
                    ->withPivot('order')
                    ->withTimestamps();
    }
}
