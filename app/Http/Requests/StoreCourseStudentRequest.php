<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseStudentRequest extends FormRequest
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
            'student_id' => 'required|exists:App\Models\Student,id',
            'course_id' => 'required|exists:App\Models\Course,id',
        ];
    }

    function messages()
    {
        return [
            'student_id.required' => 'The student field is required.',
            'course_id.required' => 'The course field is required.',
            'student_id.exists' => 'The selected student is invalid.',
            'course_id.exists' => 'The selected student is invalid.',
        ];
    }
}
