<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required',
            'email'=> 'required',
            // 'post'=> 'required',

            // 'bank'=> 'required|numeric|max:10',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=> 'Campo name obligatorio.',
            'email.required'=> 'Campo email obligatorio.',
            // 'post.required'=> 'Campo post obligatorio.',
         
            // 'province.numeric'=> 'O preço só pode ter números!',
            // 'zip.max'=> 'O preço só pode ter 8 números!',
        ]   ;
    }
}
