@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="header">
                <h4>{{ $titulo }}</h4>
            </div>
            <div class="content">
                @if(!isset($registro->id))
                    {!! Form::open(['url' => $caminho, 'files'=>true ]) !!}
                @else
                    {!! Form::model($registro, ['url' => $caminho.$registro->id, 'method'=>'put', 'files'=>true]) !!}
                @endif
                    {!! Form::hidden('id', null) !!}
                    <div class="form-group" >
                        {!! Form::label('name', 'Nome:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus'] ) !!}
                    </div>

                    <div class="form-group" >
                        {!! Form::submit('Gravar', ['class' => 'btn btn-fill btn-success']) !!}
                        <a href="{{ url($caminho) }}" class="btn btn-info" ><i class="fa fa-list"></i> Lista</a>
                        @if(!empty($registro->id))
                            <a href="{{ url($caminho.'create') }}" class="btn btn-info" ><i class="fa fa-plus"></i> Novo</a>
                        @endif
                    </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="header">
                <h4>Permissões deste papel</h4> 
            </div>
            <div class="content">
                @if(count($permissoes_disponiveis) > 0)
                    <label class="well well-sm">
                        <input type="checkbox" id="gatilho_check" onclick="toggle_check(this.id, 'permissoes')" class="btn btn-xls" > Marcar/desmarcar todas as permissões
                    </label>
                @endif
                <!-- @Matheus:
                    Tentei deixar no padrão nosso com toggle:
                    data-token="{!! csrf_token() !!}" data-toggle="switch" data-on-text="Sim" data-off-text="Não" data-size="mini"
                    Mas, ao clicar em salvar, o input não ia no post mesmo se quando checked.
                -->
                @foreach($permissoes_disponiveis as $permissao)
                    <p>
                        <label>
                        <input type="checkbox" name="permissoes[]" class="permissoes" id="p-{{ $permissao->id }}" value="{{ $permissao->name }}" <?php if($registro->hasPermissionTo($permissao->name)) echo 'checked="checked"'; ?> > {{ $permissao->name }} 
                        </label>
                    </p>
                @endforeach
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection
