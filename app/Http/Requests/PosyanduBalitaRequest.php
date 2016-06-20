<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PosyanduBalitaRequest extends Request
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
            'nama'              => 'required | max:30',
            'tanggal_lahir'     => 'required',
            'bb_lahir'          => 'required | numeric',
            'tb_lahir'          => 'required | numeric',
            'jenis_kelamin'     => 'required',
            'nama_ayah'         => 'max:30',
            'pekerjaan_ayah'    => 'max:20',
            'pekerjaan_ibu'     => 'max:20',
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
            'nama.required'         => "Kolom <b>nama lengkap</b> harus terisi",
            'nama.max'              => "Nama lengkap <b>maksimal</b> terdiri dari 30 karakter.",
            'tanggal_lahir.required'=> "Kolom <b>tanggal lahir</b> harus terisi",
            'bb_lahir.required'     => "Kolom <b>berat badan</b> harus terisi",
            'bb_lahir.numeric'      => "Berat badan <b>hanya</b> terdiri dari angka dan tanda titik, tanpa spasi atau karakter lainnya.",
            'tb_lahir.required'     => "Kolom <b>berat badan</b> harus terisi",
            'tb_lahir.numeric'      => "Tinggi badan <b>hanya</b> terdiri dari angka dan tanda titik, tanpa spasi atau karakter lainnya.",
            'jenis_kelamin.required'=> "Jenis kelamin balita harus dipilih",
            'nama_ayah.max'         => "Nama ayah <b>maksimal</b> terdiri dari 30 karakter.",
            'pekerjaan_ayah.max'    => "Pekerjaan ayah <b>maksimal</b> terdiri dari 20 karakter.",
            'pekerjaan_ibu.max'     => "Pekerjaan ibu <b>maksimal</b> terdiri dari 20 karakter.",
        ];
    }
}
