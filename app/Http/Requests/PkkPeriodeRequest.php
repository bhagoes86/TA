<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PkkPeriodeRequest extends Request
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
            'tahun_mulai'   => 'required|numeric',
            'tahun_selesai' => 'required|numeric',
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
            'tahun_mulai.required'      => "Kolom <b>tahun mulai</b> harus terisi",
            'tahun_mulai.numeric'       => "Tahun <b>hanya</b> terdiri dari angka, tanpa spasi, tanda minus (-), atau karakter lainnya.",
            'tahun_selesai.required'    => "Kolom <b>tahun selesai</b> harus terisi",
            'tahun_selesai.numeric'     => "Tahun <b>hanya</b> terdiri dari angka, tanpa spasi, tanda minus (-), atau karakter lainnya.",
        ];
    }
}
