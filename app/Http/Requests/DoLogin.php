<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoLogin extends FormRequest
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
            
            'username' => 'required|string|email|exists:shops,shop_user',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [

            'required' =>' :attribute is required',
            'string' => ' :attribute should be string',
            'email' => ' :attribute should be email'

        ];
    }


    public function attributes()
    {
       return  [

        'username' => 'Username',
        'password' => 'Password'

        ];
    }
}
