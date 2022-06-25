<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizAnswerQuestionRequest extends FormRequest
{
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
    public function rules()
    {
        return [
            "session_id" => "required|exists:quizzes_users_states,session_id",
            "question_id" => "required|exists:quizzes_questions,id",
            "answer_id" => "required|exists:quizzes_questions_answers,id"
        ];
    }
}
