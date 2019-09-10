<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            "test_id" => ["required", "numeric"],
            "topic_id" => ["required", "numeric"],
            "nick" => ["sometimes", "required", "min:2", "max:255"],
            "number" => ["required", "numeric"],
            "correct_answer" => ["required", "numeric"],
            "option_quant" => ["required", "numeric"],
            "dificult" => ["sometimes", "required", "min:1", "max:1"]
        ];
    }
}
