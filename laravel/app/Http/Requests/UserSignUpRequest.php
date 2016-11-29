<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserSignUpRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => 'required|regex:/^1[34578][0-9]{9}$/|unique:users',
            'password' => 'required|min:6'
        ];
    }

    
}
