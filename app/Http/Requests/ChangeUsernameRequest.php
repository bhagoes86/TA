<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangeUsernameRequest extends Request
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
            'username' => 'required|min:4',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => "Kolom <b>username</b> harus terisi",
            'username.min' => "Username <b>minimal</b> terdiri dari 4 karakter"
        ];
    }
}
