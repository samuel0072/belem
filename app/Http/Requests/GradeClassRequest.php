<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeClassRequest extends FormRequest
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
            "class_letter" => ["required", "max:1"],
            "grade_number" => ["required", "numeric"],
            "school_id" => ["required", "numeric"]
        ];
    }
}
