<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzesQuestion extends Model
{
    use HasFactory;

    public function translations()
    {
        return $this->hasMany(QuizzesQuestionsLanguage::class, 'quizzes_questions_id', 'id');
    }
}