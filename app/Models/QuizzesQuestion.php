<?php

namespace App\Models;

use App\Helpers\LocaleHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzesQuestion extends Model
{
    use HasFactory, ModelStringUtils;

    public function translations()
    {
        return $this->hasMany(QuizzesQuestionsLanguage::class, 'quizzes_questions_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(QuizzesQuestionsAnswer::class, 'quizzes_questions_id', 'id');
    }

    public function current_language()
    {
        return $this->translations()->whereHas("language", function ($q) {
            $q->where('language_code', LocaleHelper::get_current_locale());
        });
    }
}
