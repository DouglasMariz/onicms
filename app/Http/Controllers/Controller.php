<?php

namespace Onicms\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Auth, Request, Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     *	Verifica se o usuário logado tem permissão para fazer tal ação 
     *  Todos os controllers compartilham desta função
     **/
    public function tem_permissao($acao)
    {
        // se não é um usuário master, verifica se tem a permissão:
    	if( (!Auth::user()->role_master) && (!Auth::user()->can($acao)) ){
            Session::flash('alert-warning', 'Você não tem permissão para esta operação');
            return false;
        }
        return true;
    }
}
