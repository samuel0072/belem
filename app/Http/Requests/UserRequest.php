<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "id" => ["sometimes", "numeric", "min:1"],
            "name" => ["sometimes", "required", "min:2", "max:255"],
            "email" => ["sometimes", "required", "min:2", "max:255"],
            "password" => ["sometimes", "required", "min:8", "max:255"],
            "school_id" => ["required", "numeric"],
            "access_level" => ["required", "numeric"],
        ];
    }
}
