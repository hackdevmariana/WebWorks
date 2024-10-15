<?php

namespace Works\Dictionaryworks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DictionaryTerm extends Model
{
    protected $fillable = [
        'term', 'slug', 'abstract', 'definition', 'views', 'usage', 'author', 'status'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(DictionaryCategory::class, 'dictionary_category_term');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(DictionaryTag::class, 'dictionary_tag_term');
    }

    public function hyponyms(): HasMany
    {
        return $this->hasMany(DictionaryTermRelation::class, 'term_id')->where('relation_type', 'hyponym');
    }

    public function hypernyms(): HasMany
    {
        return $this->hasMany(DictionaryTermRelation::class, 'term_id')->where('relation_type', 'hypernym');
    }

    public function synonyms(): HasMany
    {
        return $this->hasMany(DictionaryTermRelation::class, 'term_id')->where('relation_type', 'synonym');
    }

    public function antonyms(): HasMany
    {
        return $this->hasMany(DictionaryTermRelation::class, 'term_id')->where('relation_type', 'antonym');
    }
    public function subjects()
    {
        return $this->belongsToMany(DictionarySubject::class, 'dictionary_subject_term');
    }
}
