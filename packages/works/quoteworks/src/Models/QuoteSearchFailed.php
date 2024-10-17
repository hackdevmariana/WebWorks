<?php

namespace Works\Quoteworks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteSearchFailed extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'origin',
        'repetitions',
        'error_message',
    ];
}
