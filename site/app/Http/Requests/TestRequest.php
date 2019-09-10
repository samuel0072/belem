<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
    public function rules()
    {
        return [
            "grade_class_id" => ["required", "numeric"],
            "subject_id" => ["required", "numeric"],
            "nick" => ["sometimes", "required", "min:2", "max:255"],
            "status" => ["sometimes", "required", "min:5", "max:10"]
        ];
    }
}
