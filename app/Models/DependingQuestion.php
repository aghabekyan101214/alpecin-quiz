<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependingQuestion extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->belongsTo(QuizzesQuestion::class, "question_id", "id");
    }

    public function answer()
    {
        return $this->belongsTo(QuizzesQuestionsAnswer::class, "answer_id", "id");
    }
}
