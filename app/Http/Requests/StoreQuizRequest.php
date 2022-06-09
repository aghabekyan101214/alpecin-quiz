<?php

namespace App\Http\Requests;

use App\Models\Language;
use App\Models\QuizzesLanguage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StoreQuizRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $lang_count = Language::all()->count();

        $names = Arr::pluck($request->data, 'name');
        if ($request->method == "PUT") {
            foreach ($names as $bin => $name) {
                if(QuizzesLanguage::where('quiz_id', '!=', $request->route()->quiz->id)->where('name', $name)->exists()) {
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        "data.$bin.name" => "This field should be unique"
                    ]);
                    throw $error;
                }
            }

        } else {
            foreach ($names as $bin => $name) {
                if(QuizzesLanguage::where('name', $name)->exists()) {
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        "data.$bin.name" => "This field should be unique"
                    ]);
                    throw $error;
                }
            }
        }

        return [
            "data" => "array|min:$lang_count|max:$lang_count",
            "data.*.language_id" => 'required|exists:languages,id',
            "data.*.name" => 'required|max:100'
        ];
    }
}
