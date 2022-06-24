<?php

namespace App\Http\Requests;

use App\Models\DependingQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreDependingQuestionRequest extends FormRequest
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
            "answer_id" => "required|exists:quizzes_questions_answers,id",
            "question_id" => "required|exists:quizzes_questions,id"
        ]);
        $this->check_combination($request);
        return [];
    }

    private function check_combination($request)
    {
        $query = DependingQuestion::where(["question_id" => $request->question_id, 'answer_id' => $request->answer_id]);
        if ($request->method == "PUT") {
            $query = $query->where('id', '!=', $request->route()->depending_question->id);
        }
        $data = $query->first();
        if ($data) {
            $this->throw_error('general', "This combination of answer and question has already been chosen.");
        }
    }
}
