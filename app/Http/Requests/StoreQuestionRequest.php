<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            "quiz_id" => "required|exists:quizzes,id",
            "data" => "array|min:$lang_count|max:$lang_count",
            "data.*.language_id" => 'required|exists:languages,id',
            "data.*.question" => 'required|max:255'
        ];
    }
}
