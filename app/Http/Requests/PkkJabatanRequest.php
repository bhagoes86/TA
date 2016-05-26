<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PkkJabatanRequest extends Request
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
            'nama' => 'required|max:30'
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
            'nama.required' => "Kolom <b>nama jabatan</b> harus terisi",
            'nama.max'      => "Tahun <b>maksimal</b> terdiri 30 karakter",
        ];
    }
}
