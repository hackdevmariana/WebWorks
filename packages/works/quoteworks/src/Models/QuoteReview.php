<?php
namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteReview extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'review',
        'reviewable_id',
        'reviewable_type'
    ];

    // Relación con el usuario (QuoteUser)
    public function user()
    {
        return $this->belongsTo(QuoteUser::class);
    }

    // Relación polimórfica para QuoteQuote, QuoteBook o QuoteAuthor
    public function reviewable()
    {
        return $this->morphTo();
    }
}
