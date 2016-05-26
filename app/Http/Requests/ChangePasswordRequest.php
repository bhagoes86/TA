<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangePasswordRequest extends Request
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
            'old_pass' => 'required',
            'new_pass' => 'required|min:4',
            're_new_pass' => 'required|same:new_pass',
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
            'old_pass.required' => "Kolom <b>kata sandi lama</b> harus terisi",
            'new_pass.required' => "Kolom <b>kata sandi baru</b> harus terisi",
            're_new_pass.required' => "Kolom <b>konfirmasi kata sandi baru</b> harus terisi",
            'new_pass.min' => "Kata sandi <b>minimal</b> terdiri dari 4 karakter",
            're_new_pass.same' => "Kolom <b>konfirmasi kata sandi baru</b> tidak sesuai",
        ];
    }
}
