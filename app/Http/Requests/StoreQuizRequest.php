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

    private function get_quiz_language_query($name)
    {
        return QuizzesLanguage::where('name', $name);
    }

    private function throw_error($key, $err)
    {
        $error = \Illuminate\Validation\ValidationException::withMessages([
            $key => $err
        ]);
        throw $error;
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
                $query = $this->get_quiz_language_query($name);
                if($query->where('quiz_id', '!=', $request->route()->quiz->id)->exists()) {
                    $this->throw_error("data.$bin.name", "This field should be unique");
                }
            }

        } else {
            foreach ($names as $bin => $name) {
                $query = $this->get_quiz_language_query($name);
                if($query->exists()) {
                    $this->throw_error("data.$bin.name", "This field should be unique");
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
