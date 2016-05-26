<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PkkJentikFilterRequest extends Request
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
            'year' => 'required|numeric',
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
            'year.required' => "Kolom <b>tahun</b> harus terisi",
            'year.numeric'  => "Tahun <b>hanya</b> terdiri dari angka",
        ];
    }
}
