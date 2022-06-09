<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LanguageStoreRequest extends FormRequest
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
        return [
            "language_code" => 'required|max:10|unique:languages,language_code,' . $request->method == 'PUT' ? ($request->route()->language->id) : '',
            'icon' => $request->method != 'PUT' ?  'required' : '',
        ];
    }
}
