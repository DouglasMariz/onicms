<?php

namespace Onicms\Http\Controllers\Admin;

use Onicms\Models\User;
use Spatie\Permission\Models\Role;

use Response, Auth, Session;
use Illuminate\Http\Request;

use Onicms\Http\Requests;
use Onicms\Http\Requests\UserRequest;
use Onicms\Http\Controllers\Controller;

class UserController extends Controller
{
    public $caminho = 'admin/user/';
    public $titulo = 'Usuários do Sistema';
    public $papeis_disponiveis;

    public function __construct()
    {
        $this->papeis_disponiveis = ['' => '-'] + Role::orderBy('name')->lists('name','name')->toArray();
    }

    public function index()
    {
        // o admin geral não aparece nos usuários e apenas ele pode editar seu próprio registro
        // o admin geral é único
        $registros = User::where('role_master', '=', 0)->get();
        $registros = configurar_status_toogle($registros, $this->caminho);
        return view($this->caminho.'.index',['registros'=>$registros],[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function create()
    {
        if(!$this->tem_permissao('Usuários: cadastrar'))
            return redirect($this->caminho);

        $html_toggle = gerar_status_toggle( array('status' => 1) ); 
        return view($this->caminho.'.form',[
                    'titulo' => $this->titulo,
                    'html_toggle' => $html_toggle,
                    'caminho' => $this->caminho,
                    'papeis_disponiveis' => $this->papeis_disponiveis,
               ]);
    }

    public function store(UserRequest $request)
    {
        $input = $request->all();

        // o role master é único no sistema:
        $input['role_master'] = 0;
        if(isset($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        if(isset($input['foto']))
            $input['foto'] = $this->upload($input['foto']);
        if(!isset($input['status']))
            $input['status'] = 0;
        $user = User::create($input);

        if(isset($input['role']) && (!empty($input['role']))){
            $user->assignRole($input['role']);
        }

        $request->session()->flash('alert-success', config('mensagens.registro_inserido'));
        return redirect($this->caminho.'create');
    }

    public function show($id)
    {
        $registro = User::where('id', '=', $id)->with('roles')->first();

        // não mostra o admin master se for outro usuário tentando acessá-lo:
        if( (!Auth::user()->role_master) && ($registro->role_master) ){
            Session::flash('alert-warning', 'Acesso negado');
            return redirect($this->caminho);
        }

        $html_toggle = gerar_status_toggle( $registro );
        return view($this->caminho.'.form', compact('registro'),[
                    'titulo' => $this->titulo,
                    'html_toggle' => $html_toggle,
                    'caminho' => $this->caminho,
                    'papeis_disponiveis' => $this->papeis_disponiveis,
               ]);
    }

    public function update(UserRequest $request, $id)
    {

        // Um usuário pode alterar seus dados, mas só alguns usuários podem editar outros:
        if((Auth::user()->id != $id))
            if(!$this->tem_permissao('Usuários: editar'))
                return redirect($this->caminho.$id.'');

        $input = $request->all();
        if(isset($input['alterar_senha']) && !empty($input['alterar_senha']) ){
            $input['password'] = bcrypt($input['alterar_senha']);
        }
        if(!isset($input['status']))
            $input['status'] = 0;

        $user = User::find($id)->update($input);

        // limpa os papéis existentes para inserir o novo caso tenha alterado:
        \DB::table('user_has_roles')->where('user_id','=',$id)->delete();
        if(isset($input['role']) && (!empty($input['role']))){
            User::find($id)->assignRole($input['role']);
        }

        $request->session()->flash('alert-success', config('mensagens.registro_alterado'));
        return redirect($this->caminho.$id.'');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect($this->caminho);
    }

    // Atualiza um campo boolean de um registro via ajax
    public function atualizar_status($id, $coluna = 'status')
    {
        // Verifica o status atual e dá um update com o novo status:
        $registro = User::find($id);
        // Se encontrou o registro:
        if(isset($registro->{$coluna})){
            $novo = !$registro->{$coluna};
            $update = User::find($id)->update( array( $coluna =>$novo ) );
            $resposta['success'] = 'success';
            $resposta['status']  = '200';
        }else{
            $resposta['success'] = 'fail';
            $resposta['status']  = '0';
        }
        return Response::json($resposta);
    }

}





























