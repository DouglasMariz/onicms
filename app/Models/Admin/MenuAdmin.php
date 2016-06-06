<?php

namespace Onicms\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Baum\Node; //https://github.com/etrepat/baum

use Illuminate\Database\Eloquent\SoftDeletes;

class MenuAdmin extends Node
{
	use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'menu_admin';

    protected $fillable = ['nome', 'url', 'icone', 'peso', 'parent_id', 'status'];

    protected $orderColumn = 'peso';
}
