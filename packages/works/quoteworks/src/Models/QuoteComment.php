<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteComment extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'comment',
        'commentable_id',
        'commentable_type'
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica
    public function commentable()
    {
        return $this->morphTo();
    }
}
