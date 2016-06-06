<?php

namespace Onicms\Http\Controllers\Admin;

use Onicms\Models\User;

use Validator, Response;
use Illuminate\Http\Request;

use Onicms\Http\Requests;
use Onicms\Http\Requests\UserRequest;
use Onicms\Http\Controllers\Controller;

class UserController extends Controller
{
    public $caminho = 'admin/user/';
    public $titulo = 'Usuários do Sistema';

    public function __construct()
    {

    }

    public function index()
    {
        $registros = User::all();
        $registros = configurar_status_toogle($registros, $this->caminho);
        return view($this->caminho.'.index',['registros'=>$registros],[
                    'titulo' => $this->titulo,
                    'caminho' => $this->caminho,
               ]);
    }

    public function create()
    {
        $html_toggle = gerar_status_toggle( array('status' => 1) );
        return view($this->caminho.'.form',[
                    'titulo' => $this->titulo,
                    'html_toggle' => $html_toggle,
                    'caminho' => $this->caminho,
               ]);
    }

    public function store(UserRequest $request)
    {
        $input = $request->all();
        if(isset($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }
        if(isset($input['foto']))
            $input['foto'] = $this->upload($input['foto']);
        if(!isset($input['status']))
            $input['status'] = 0;
        User::create($input);

        $request->session()->flash('alert-success', config('mensagens.registro_inserido'));
        return redirect($this->caminho);
    }

    public function show($id)
    {
        $registro = User::find($id);
        $html_toggle = gerar_status_toggle( $registro );
        return view($this->caminho.'.form', compact('registro'),[
                    'titulo' => $this->titulo,
                    'html_toggle' => $html_toggle,
                    'caminho' => $this->caminho,
               ]);
    }

    public function update(UserRequest $request, $id)
    {
        $input = $request->all();
        if(isset($input['alterar_senha']) && !empty($input['alterar_senha']) ){
            $input['password'] = bcrypt($input['alterar_senha']);
        }
        if(!isset($input['status']))
            $input['status'] = 0;
        $update = User::find($id)->update($input);

        $request->session()->flash('alert-success', config('mensagens.registro_alterado'));
        return redirect($this->caminho.$id.'');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect($this->caminho);
    }

    public function upload($image)
    {
        if(empty($image))
            return false;

        $pasta = User::pasta();
        //obtem o nome e cria um novo
        $extension = $image->getClientOriginalExtension();
        $alt = explode('.', $image->getClientOriginalname());
        $filename = $alt[0] . '-' . date('dhis');

        $image->move($pasta.'/tmp/', $filename . '.' . $extension);
        $imagem = new Imagens();
        $imagem->imagemCortar('User', $filename, $extension);
        return $filename . '.' . $extension;
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





























