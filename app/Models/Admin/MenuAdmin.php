<?php

namespace Onicms\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Baum\Node; //https://github.com/etrepat/baum

class MenuAdmin extends Node
{
    public $table = 'menu_admin';

    protected $fillable = ['nome', 'url', 'icone', 'peso', 'parent_id'];

    protected $orderColumn = 'peso';
}
