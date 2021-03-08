<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
          'id' => 'required|max:255',
          'name' => 'required|max:255',
          'email' => 'email|max:255',
          'password' => 'required|min:6|confirmed',
          'tipo' => 'required',
        ];
    }
}
