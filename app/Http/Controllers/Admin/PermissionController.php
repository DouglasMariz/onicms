<?php

namespace Onicms\Http\Controllers\Admin;

use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

use Onicms\Http\Requests;
use Onicms\Http\Requests\PermissionRequest;
use Onicms\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public $caminho = 'admin/permission/';
    public $titulo = 'Permissões';

    public function __construct()
    {

    }

    public function index()
    {
        $registros = Permission::all();
        return view($this->caminho.'.index',['registros'=>$registros],[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function create()
    {
        return view($this->caminho.'.form',[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function store(PermissionRequest $request)
    {
        $input = $request->all();
        Permission::create($input);

        $request->session()->flash('alert-success', config('mensagens.registro_inserido'));
        return redirect($this->caminho.'create');
    }

    public function show($id)
    {
        $registro = Permission::find($id);
        return view($this->caminho.'.form', compact('registro'),[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function update(PermissionRequest $request, $id)
    {
        $input = $request->all();
        $update = Permission::find($id)->update($input);

        $request->session()->flash('alert-success', config('mensagens.registro_alterado'));
        return redirect($this->caminho.$id.'');
    }

    public function destroy($id)
    {
        Permission::find($id)->delete();
        return redirect($this->caminho);
    }

}
