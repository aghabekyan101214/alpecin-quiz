<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuizzesQuestionsAnswersRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $lang_count = Language::all()->count();
        return [
            "quizzes_questions_id" => "required|exists:quizzes_questions,id",
            "data" => "array|min:$lang_count|max:$lang_count",
            "data.*.language_id" => 'required|exists:languages,id',
            "data.*.answer" => 'required|max:255'
        ];
    }
}
