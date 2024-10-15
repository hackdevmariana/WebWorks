<?php

namespace Works\Dictionaryworks\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryTermRelation extends Model
{
    protected $table = 'dictionary_term_relations';

    protected $fillable = [
        'term_id',
        'related_term_id',
        'relation_type',
    ];

    public function term()
    {
        return $this->belongsTo(DictionaryTerm::class, 'term_id');
    }

    public function relatedTerm()
    {
        return $this->belongsTo(DictionaryTerm::class, 'related_term_id');
    }
}
