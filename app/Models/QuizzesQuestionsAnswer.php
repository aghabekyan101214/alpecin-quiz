<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzesQuestionsAnswer extends Model
{
    use HasFactory, ModelStringUtils;

    public function translations()
    {
        return $this->hasMany(QuizzesQuestionsAnswersLanguage::class, 'quizzes_questions_answers_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(QuizzesQuestion::class, 'quizzes_questions_id', 'id');
    }
}
