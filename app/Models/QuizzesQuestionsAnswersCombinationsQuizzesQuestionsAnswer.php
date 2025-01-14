<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzesQuestionsAnswersCombinationsQuizzesQuestionsAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function answer()
    {
        return $this->belongsTo(QuizzesQuestionsAnswer::class, 'quizzes_questions_answer_id', 'id');
    }
}
