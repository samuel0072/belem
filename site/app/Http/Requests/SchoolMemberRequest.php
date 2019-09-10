<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//todo: autorizacao
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => ["required", "min:2", "max:255"],
                'age' => ["required", "numeric"],
                'enroll' => ["required", "numeric"],
                'type' => ["required", "min:5", "max:9"],//aluno, professor
                'grade_class_id' => ["required", "numeric"]
        ];
    }
}
