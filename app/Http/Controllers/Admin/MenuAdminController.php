<?php

namespace Onicms\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Onicms\Http\Requests;

use Onicms\Models\Admin\MenuAdmin;
use Onicms\Http\Requests\MenuAdminRequest;

use Onicms\Http\Controllers\Controller;

class MenuAdminController extends Controller
{
    public $caminho = 'admin/menu_admin/';
    public $titulo = 'Menus do Sistema';
    public $rotas;

    public function __construct()
    {
        // pega as rotas para usar na inserção/edição de menu
        $this->rotas = ['' => ''] + getRotasAdmin(); //helpers.php
    }

    public function index()
    {
        $registros = MenuAdmin::all();
        return view($this->caminho.'.index',['registros'=>$registros],[
                    'titulo'  => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function create()
    {
        $menus = [''=>''] + MenuAdmin::lists('nome', 'id')->all();
        return view($this->caminho.'.form',[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
                    'menus'   => compact('menus'),
                    'rotas_disponiveis' => $this->rotas,
               ]);
    }

    public function store(MenuAdminRequest $request)
    {
        $input = $request->all();
        if(empty($input['parent_id']))
            $input['parent_id'] = NULL;
        $node = MenuAdmin::create($input);
        $node->save();

        $request->session()->flash('alert-success', config('mensagens.registro_inserido'));
        return redirect($this->caminho.'create');
    }

    public function show($id)
    {
        $registro = MenuAdmin::find($id);
        $menus = [''=>''] + MenuAdmin::lists('nome', 'id')->all();
        return view($this->caminho.'.form', compact('registro'),[
                    'titulo'  => $this->titulo,
                    'caminho' => $this->caminho,
                    'menus'   => compact('menus'),
                    'rotas_disponiveis' => $this->rotas,
               ]);
    }

    public function update(MenuAdminRequest $request, $id)
    {
        $input = $request->all();
        if(empty($input['parent_id']))
            $input['parent_id'] = NULL;
        $update = MenuAdmin::find($id)->update($input);

        $request->session()->flash('alert-success', config('mensagens.registro_alterado'));
        return redirect($this->caminho.$id);
    }

    public function destroy($id)
    {
        MenuAdmin::find($id)->delete();
        return redirect($this->caminho);
    }
}
