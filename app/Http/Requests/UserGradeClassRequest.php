<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGradeClassRequest extends FormRequest
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
            'grade_class_id' => ['required', 'numeric', 'min:1'],
            'user_id' => ['required', 'numeric', 'min:1']
        ];
    }
}
