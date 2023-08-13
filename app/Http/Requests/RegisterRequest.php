<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required|max:255',
            'email'=>'email|required',
            'password'=>'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attributes không được trống',
            'email'=>':attributes không phải email',
            'max'=>':attributes vượt quá max kí tự',
        ];
    }
}
