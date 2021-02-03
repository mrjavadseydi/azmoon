<?php

namespace MrjavadSeydi\AdminLTE\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required|max:12',
            'phone_verify' => "in:0,1",
            'repassword'=>'same:password'
        ];
    }
}
