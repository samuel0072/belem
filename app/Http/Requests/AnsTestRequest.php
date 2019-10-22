<?php

namespace App\Http\Requests;

use App\SchoolMember;
use Illuminate\Foundation\Http\FormRequest;

class AnsTestRequest extends FormRequest
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
            "test_id" => ["required", "numeric", "min:1"],
            "grade_class_id" => ["required", "numeric", "min:1"],
            "school_member_id" => ["required", "numeric"],
            "score" => ["sometimes", "required", "numeric", "min:0", "max:10"],
            "done" => ["sometimes", "required", "boolean"]
        ];
    }
}
