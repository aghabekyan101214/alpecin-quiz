<?php

namespace App\Http\Requests;

use App\Models\QuizzesQuestionsAnswer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class QuizAnswerQuestionRequest extends FormRequest
{
    use ValidationErrorHelper;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $request->validate([
            "session_id" => "required|exists:quizzes_users_states,session_id",
            "question_id" => "required|exists:quizzes_questions,id",
            "answer_id" => "required|exists:quizzes_questions_answers,id"
        ]);
        $answer = QuizzesQuestionsAnswer::where('id', $request->answer_id)->first();
        if ($answer->quizzes_questions_id != $request->question_id) $this->throw_error('general', '');
        return [];
    }
}
