<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzesUsersFeedback extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function combination()
    {
        return $this->belongsTo(QuizzesQuestionsAnswersCombination::class, "combination_id", "id");
    }
}
