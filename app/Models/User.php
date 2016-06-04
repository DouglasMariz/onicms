<?php

/**
*   Este model está na raiz de Models porque pode ser usado 
*   tanto no admin quando para logar um usuário no site,
*   então dessa forma não misturamos as coisas
**/

namespace Onicms\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
