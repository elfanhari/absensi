<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class KelasRequest extends FormRequest
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
      $unique = Rule::unique('kelas')->ignore($this->id);

      return [
          'name' => ['required', $unique],
          'jurusan_id' => ['required'],
          'guru_id' => ['required'],
          'tingkat' => ['required'],
          'tapel_id' => ['required'],
      ];
    }
}
