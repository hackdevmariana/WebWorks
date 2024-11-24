<?php
namespace Works\Web\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    use HasFactory;

    // Especificamos explícitamente el nombre de la tabla
    protected $table = 'question_answers'; // Asegúrate de que el nombre sea el correcto

    protected $fillable = [
        'web_id',
        'title',
        'slug',
        'question',
        'answer',
        'category',
    ];

    public function web()
    {
        return $this->belongsTo(Web::class);
    }

    public function faq()
    {
        return $this->belongsTo(FAQ::class); // Se espera que se use faq_id como clave foránea
    }
}
