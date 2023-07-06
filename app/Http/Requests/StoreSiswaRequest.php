<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiswaRequest extends FormRequest
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
          'username' => ['required', 'unique:users'],
          'password' => ['required'],
          'kelas_id' => ['required'],
          'name' => ['required'],
          'jk' => ['required'],
          'nis' => ['required'],
          'nisn' => ['required'],
          // 'alamat' => ['required'],
          // 'telepon' => ['required'],
        ];
    }
}
