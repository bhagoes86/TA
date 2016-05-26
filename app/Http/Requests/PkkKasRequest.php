<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PkkKasRequest extends Request
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
            'nominal' => 'required|numeric',
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
            'nominal.required'  => "Kolom <b>nominal</b> harus terisi",
            'nominal.numeric'   => "Nominal <b>hanya</b> terdiri dari angka, tanpa spasi, tanda minus (-), atau karakter lainnya.",
        ];
    }
}
