<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PosyanduIbuRequest extends Request
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
            'no_ktp'            => 'required | digits:16 | regex:/^[0-9]+$/',
            'alamat'            => 'max:255',
            'telp'              => 'numeric | regex:/^\+?[0-9]+$/',
            'kb'                => 'max:20',
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
            'no_ktp.required'       => "Kolom <b>nomor KTP</b> harus terisi",
            'no_ktp.regex'          => "Nomor KTP <b>harus</b> terdiri dari 16 angka, tanpa spasi, tanda titik (.), atau karakter lainnya.",
            'no_ktp.digits'         => "Nomor KTP <b>harus</b> terdiri dari 16 angka, tanpa spasi, tanda titik (.), atau karakter lainnya.",
            'alamat.max'            => "Alamat <b>maksimal</b> terdiri dari 255 karakter.",
            'telp.numeric'          => "Nomor telepon <b>hanya</b> terdiri dari angka dan/atau tanda plus (+), tanpa spasi, tanda titik (.), atau karakter lainnya.",
            'telp.regex'            => "Nomor telepon <b>hanya</b> terdiri dari angka dan/atau tanda plus (+), tanpa spasi, tanda titik (.), atau karakter lainnya.",
            'kb.max'                => "KB <b>maksimal</b> terdiri dari 20 karakter.",
        ];
    }
}
