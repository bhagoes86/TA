<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PosyanduPenimbanganRequest extends Request
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
            'umur'          => 'required | integer | max:60',
            'tanggal'       => 'required',
            'berat'         => 'required | regex:/^\d+(\.[0-9])?[0-9]?$/',
            'tinggi'        => 'required | regex:/^\d+(\.[0-9])?[0-9]?$/',
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
            'umur.required'         => "Kolom <b>umur</b> harus terisi",
            'umur.integer'          => "Umur <b>hanya</b> terdiri dari angka",
            'umur.max'              => "Umur <b>maksimal</b> adalah 60 bulan",
            'tanggal.required'      => "Kolom tanggal <b>harus</b> terisi",
            'berat.required'        => "Kolom berat <b>harus</b> terisi",
            'berat.regex'           => "Berat <b>hanya</b> terdiri dari angka. Gunakan <b>titik (.)</b> untuk angka <b>desimal</b> (2 angka dibelakang koma)",
            'tinggi.required'       => "Kolom tinggi <b>harus</b> harus terisi",
            'tinggi.regex'          => "Tinggi <b>hanya</b> terdiri dari angka. Gunakan <b>titik (.)</b> untuk angka <b>desimal</b> (2 angka dibelakang koma)",
        ];
    }
}
