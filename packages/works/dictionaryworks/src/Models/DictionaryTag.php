<?php

namespace Works\Dictionaryworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryTag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    // Relación muchos a muchos con DictionaryTerm
    public function terms()
    {
        return $this->belongsToMany(DictionaryTerm::class, 'dictionary_tag_term');
    }
}
