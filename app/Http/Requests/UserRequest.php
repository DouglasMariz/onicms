<?php

namespace Onicms\Http\Requests;

use Onicms\Http\Requests\Request;

class UserRequest extends Request
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
        $validacao = [
            'name'  => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'password' => 'sometimes|required|between:6,10|confirmed',
            'alterar_senha' => 'sometimes|between:6,10|confirmed',
        ];

        return $validacao;
    }
}
