<?php

/**
*   Este model está na raiz de Models porque pode ser usado 
*   tanto no admin quando para logar um usuário no site,
*   então dessa forma não misturamos as coisas
**/

namespace Onicms\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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
