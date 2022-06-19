<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzesQuestionsAnswersCombination extends Model
{
    use HasFactory;

    public function answers()
    {
        return $this->hasMany(QuizzesQuestionsAnswersCombinationsQuizzesQuestionsAnswer::class, 'quizzes_questions_answers_combination_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(QuizzesQuestionsAnswersCombinationsProducts::class, 'quizzes_questions_answers_combination_id', 'id');
    }
}
