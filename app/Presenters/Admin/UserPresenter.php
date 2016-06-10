<?php

namespace Onicms\Presenters\Admin;

use Onicms\Presenters\BasePresenter;

class UserPresenter extends BasePresenter
{
	/**
     * Retorna apenas o primeiro nome do usuário
     *
     * @var string nome
     */
    public function first_name()
    {
        $nome = explode(' ',$this->name);
        if(is_array($nome))
            $nome = $nome[0];

        return ucfirst($nome);
    }

    public function papel()
    {
        // se for master:
        if($this->role_master){
            return 'Administrador geral';
        }

        if(isset($registro->roles()->first()->name))
            return $registro->roles()->first()->name;

        return '-';
    }
}