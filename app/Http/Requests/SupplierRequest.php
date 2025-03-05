<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'supplier'=> 'required',
            // 'country'=> 'required',
            // 'province'=> 'required',
            // 'zip'=> 'required',
            // 'city'=> 'required',
            // 'street'=> 'required',

            // 'bank'=> 'required|numeric|max:10',
        ];
    }
    public function messages(): array
    {
        return [
            'supplier.required'=> 'Campo supplier obligatorio.',
            // 'country.required'=> 'Campo country obligatorio.',
            // 'province.required'=> 'Campo province obligatorio.',
            // 'zip.required'=> 'Campo zip obligatorio.',
            // 'city.required'=> 'Campo city obligatorio.',
            // 'street.required'=> 'Campo street obligatorio.',            
            // 'province.numeric'=> 'O preço só pode ter números!',
            // 'zip.max'=> 'O preço só pode ter 8 números!',
        ]   ;
    }
}
