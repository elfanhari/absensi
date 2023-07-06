<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SekolahRequest extends FormRequest
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
        'name'      => ['required'],
        // 'npsn'     => ['required'],
        // 'nss'        => ['numeric', 'nullable'],
        'kodepos'       => ['numeric'],
        'telepon'      => ['required', 'numeric'],
        'alamat'     => ['required'],
        // 'website'  => ['required'],
        'email' => ['required', 'email'],
        'alamat'       => ['required'],
        'kepsek'       => ['required'],
        'nipkepsek'       => ['required'],
      ];
    }
}
