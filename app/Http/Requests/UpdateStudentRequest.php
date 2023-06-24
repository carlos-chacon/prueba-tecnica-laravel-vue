<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'max:100|required',
            'last_name' => 'max:100|required',
            'birth_year' => ['integer', 'digits_between:4,4', 'min:1900', 'max:' . date('Y')],
            'email' => 'email',
        ];
    }

    // public function messages(): array
    // {

    //     return  [
    //         'birth_year.integer' => 'El año de nacimiento debe ser un número entero.',
    //         'birth_year.digits_between' => 'El año de nacimiento debe tener 4 dígitos.',
    //         'birth_year.min' => 'El año de nacimiento debe ser igual o posterior a 1900.',
    //         'birth_year.max' => 'El año de nacimiento no puede ser posterior al año actual.',
    //     ];
    // }
}
