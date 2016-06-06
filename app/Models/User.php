<?php

/**
*   Este model está na raiz de Models porque pode ser usado 
*   tanto no admin quando para logar um usuário no site,
*   então dessa forma não misturamos as coisas
**/

namespace Onicms\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Laracasts\Presenter\PresentableTrait;

class User extends Authenticatable
{
    use PresentableTrait;
    protected $presenter = 'Onicms\Presenters\Admin\UserPresenter';

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
}
