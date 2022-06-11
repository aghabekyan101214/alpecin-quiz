<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreProductRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $lang_count = Language::all()->count();
        return [
            "image" => $request->method !== "PUT" ? "required" : "",
            "data" => "array|min:$lang_count|max:$lang_count",
            "data.*.language_id" => 'required|exists:languages,id',
            "data.*.name" => 'required|max:255',
            "data.*.description" => 'max:3000',
        ];
    }
}
