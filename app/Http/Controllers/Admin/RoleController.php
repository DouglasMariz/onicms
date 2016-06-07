<?php

namespace Onicms\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

use Onicms\Http\Requests;
use Onicms\Http\Requests\RoleRequest;
use Onicms\Http\Controllers\Controller;

class RoleController extends Controller
{
    public $caminho = 'admin/role/';
    public $titulo = 'Papéis de usuários';
    public $permissoes_disponiveis;
    public $registro_permissoes = array();

    public function __construct()
    {
    	$this->permissoes_disponiveis = Permission::orderBy('name')->get();
    }

    public function index()
    {
        $registros = Role::all();
        return view($this->caminho.'.index',['registros'=>$registros],[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function create()
    {
        //$this->configurar_status_permissoes();
        return view($this->caminho.'.form',[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
                    'permissoes_disponiveis' => $this->permissoes_disponiveis,
                    'registro_permissoes' => $this->registro_permissoes,
               ]);
    }

    public function store(RoleRequest $request)
    {
        $input = $request->all();
        $role['name'] = $input['name'];
        $role  = Role::create($role);
        $this->salvar_permissoes($role->id, $input);

        $request->session()->flash('alert-success', config('mensagens.registro_inserido'));
        return redirect($this->caminho.'create');
    }

    public function show($id)
    {
        $registro = Role::find($id);
        // Aqui configura os inputs toggles de cada permissão:
        //$this->configurar_status_permissoes($registro);

        return view($this->caminho.'.form', compact('registro'),[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
                    'permissoes_disponiveis' => $this->permissoes_disponiveis,
                    'registro_permissoes' => $this->registro_permissoes,
               ]);
    }

    public function update(RoleRequest $request, $id)
    {
        $input = $request->all();
        $role['name'] = $input['name'];
        $role = Role::find($id)->update($role);
        $this->salvar_permissoes($id, $input);
        $request->session()->flash('alert-success', config('mensagens.registro_alterado'));
        return redirect($this->caminho.$id.'');
    }

    public function destroy($id)
    {
        Role::find($id)->delete();
        return redirect($this->caminho);
    }


    public function salvar_permissoes($id, $input)
    {
    	// Apaga as permissões atuais para add as novas:
    	\DB::table('role_has_permissions')->where('role_id','=',$id)->delete();
    	$role = Role::find($id);
    	// Salva as novas:
    	if(isset($input['permissoes'])){
    		foreach($input['permissoes'] as $p){
    			$role->givePermissionTo($p);
    		}
    	}
    	return true;
    }

    /*
     *  Passa por cada permissão disponível e verifica se a role tem permissão nela para configurar o toggle:
     */
    public function configurar_status_permissoes($registro = ''){
        foreach($this->permissoes_disponiveis as $permissao){
            $checked = '';
            if(isset($registro->id) && ($registro->hasPermissionTo($permissao->name)))
                $checked = 'checked="checked"';
            // retorna com o input:
            $this->registro_permissoes[$permissao->name] = '<input type="checkbox" name="permissoes[]" '.$checked.' id="p-'.$permissao->id.'" data-toggle="switch" data-on-text="Sim" data-off-text="Não" data-size="mini" value="'.$permissao->name.'">';
        }
    }
}








