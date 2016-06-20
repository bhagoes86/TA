<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PkkIbuRequest extends Request
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
            'no_ktp'            => 'required|size:16',
            'nama'              => 'required|max:30',
            'alamat'            => 'required|max:255',
            'telp'              => 'required|numeric',
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
            'no_ktp.required'       => "Kolom <b>nomor KTP</b> harus terisi",
            'no_ktp.size'           => "Nomor KTP <b>harus</b> terdiri dari 16 angka",
            'no_ktp.numeric'        => "Nomor KTP <b>hanya</b> terdiri dari 16 angka, tanpa spasi atau karakter lainnya",
            'nama.required'         => "Kolom <b>nama lengkap</b> harus terisi",
            'nama.max'              => "Nama lengkap <b>maksimal</b> terdiri dari 30 karakter. Hubungi pengurus atau administrator apabila bermasalah.",
            'alamat.required'       => "Kolom <b>alamat</b> harus terisi",
            'alamat.max'            => "Alamat <b>maksimal</b> terdiri dari 255 karakter. Hubungi pengurus atau administrator apabila bermasalah.",
            'telp.required'         => "Kolom <b>nomor telepon</b> harus terisi",
            'telp.numeric'          => "Nomor telepon <b>hanya</b> terdiri dari angka, tanpa spasi, tanda minus (-), atau karakter lainnya. Hubungi pengurus atau administrator apabila bermasalah.",
        ];
    }
}
