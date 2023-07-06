<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilRequest extends FormRequest
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
      $role = auth()->user()->role;

      if ($role == 'admin' || $role == 'guru') {
        return [
          'name'      => ['required'],
          'jk'        => ['required'],
          // 'nip'       => ['numeric'],
          // 'nuptk'     => ['numeric'],
          // 'telepon'      => ['required', 'numeric'],
          // 'alamat'       => ['required'],
        ];
      }

      elseif ($role == 'siswa') {
        return [
          // 'token' => ['required'],
          'jk' => ['required'],
          // 'telepon' => ['required', 'numeric'],
        ];
      }
    }
}
