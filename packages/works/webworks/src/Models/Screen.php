<?php
namespace Works\Webworks\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Screen extends Model
{
    use HasFactory;

    protected $fillable = ['website_id', 'screen', 'width'];

    public function customMenus()
    {
        return $this->belongsToMany(CustomMenu::class, 'menu_screen')
                    ->withTimestamps();
    }
}
