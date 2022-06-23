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
        return $this->hasMany(QuizzesQuestionsLanguage::class, 'quizzes_questions_id', 'id')->whereHas("language", function ($q) {
            $q->where('language_code', LocaleHelper::get_current_locale());
        });
    }

    public function answers()
    {
        return $this->hasMany(QuizzesQuestionsAnswer::class, 'quizzes_questions_id', 'id');
    }
}
