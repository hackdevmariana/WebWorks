<?php
namespace Works\Webworks\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'website_id', 'username', 'name', 'surname', 'links', 'photo', 'biography'
    ];
}
