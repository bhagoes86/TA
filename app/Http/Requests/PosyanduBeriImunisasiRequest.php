<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PosyanduBeriImunisasiRequest extends Request
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
            'id_imunisasi'  => 'required',
            'tanggal'       => 'required',
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
            'id_imunisasi.required' => "Kolom jenis imunisasi <b>harus</b> terisi",
            'tanggal.required'      => "Kolom tanggal <b>harus</b> terisi",
        ];
    }
}
