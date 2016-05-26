<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'password' => 'required|min:4',
            're_password' => 'required|same:password',
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
            'username.min' => "Username <b>minimal</b> terdiri dari 4 karakter",
            'password.required' => "Kolom <b>kata sandi baru</b> harus terisi",
            're_password.required' => "Kolom <b>konfirmasi kata sandi baru</b> harus terisi",
            'password.min' => "Kata sandi <b>minimal</b> terdiri dari 4 karakter",
            're_password.same' => "Kolom <b>konfirmasi kata sandi baru</b> tidak sesuai",
        ];
    }
}
