<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image'=>'image|max:5025',
            'title'=>'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attributes không được trống',
            'max'=>':attributes không được quá max: kí tự',
            'mimes'=>':attributes không phải file ảnh',
        ];
    }
}
