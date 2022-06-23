<?php

namespace App\Models;

use App\Helpers\LocaleHelper;
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

    public function current_language()
    {
        return $this->translations()->whereHas("language", function ($q) {
            $q->where('language_code', LocaleHelper::get_current_locale());
        });
    }
}
