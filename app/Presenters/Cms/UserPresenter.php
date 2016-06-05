<?php

namespace Onicms\Presenters\Cms;

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
}