<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'firstname'=>"required|max:200",
            'lastname'=>"required|max:200",
            'mobile'=>"required|starts_with:09|min:10|max:13|unique:users",
            'password'=>"required|same:repassword"
        ];
    }
}
