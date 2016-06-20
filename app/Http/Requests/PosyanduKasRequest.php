<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PosyanduKasRequest extends Request
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
            'id_jenis'         => 'required',
            'tanggal'           => 'required',
            'nominal'           => 'required|integer',
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
            'id_jenis.required'       => "Kolom <b>jenis kas</b> harus terisi",
            'tanggal.required'         => "Kolom <b>tanggal</b> harus terisi",
            'nominal.required'         => "Kolom <b>nominal</b> harus terisi",
            'nominal.integer'          => "Kolom nominal <b>hanya</b> berisi angka",
        ];
    }
}
