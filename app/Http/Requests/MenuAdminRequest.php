<?php

namespace Onicms\Http\Requests;

use Onicms\Http\Requests\Request;

class MenuAdminRequest extends Request
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
            'nome'  => 'required',
            'url'   => '',
        ];
        return $validacao;
    }
}
