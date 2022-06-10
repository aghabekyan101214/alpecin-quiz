<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    public function translations()
    {
        return $this->hasMany(QuizzesQuestionsLanguage::class, "quiz_question_id", "id");
    }
}
