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
                    <div class="form-group" >
                        {!! Form::label('name', 'Nome:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=> 'Digite o nome completo', 'autofocus'] ) !!}
                    </div>

                    <div class="form-group" >
                        {!! Form::label('email', 'E-mail:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder'=> 'Digite o e-mail'] ) !!}
                    </div>

                    <div class="form-group" >
                        {!! $html_toggle !!}
                    </div>

                    @if(empty($registro->id))
                        <div class="form-group" >
                            {!! Form::label('password', 'Senha:') !!}
                            {!! Form::password('password', ['class' => 'form-control'] ) !!}
                        </div>

                        <div class="form-group" >
                            {!! Form::label('password_confirmation', 'Confirme a senha:') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control'] ) !!}
                        </div>
                    @endif

                    @if( isset($registro->id) && Auth::user()->id == $registro->id)
                        <div class="form-group" >
                            {!! Form::label('alterar_senha', 'Alterar minha senha:') !!}
                            {!! Form::password('alterar_senha', ['class' => 'form-control'] ) !!}
                        </div>

                        <div class="form-group" >
                            {!! Form::label('alterar_senha_confirmation', 'Confirme a nova senha:') !!}
                            {!! Form::password('alterar_senha_confirmation', ['class' => 'form-control'] ) !!}
                        </div>
                    @endif

                    <div class="form-group" >
                        {!! Form::submit('Gravar', ['class' => 'btn btn-fill btn-success']) !!}
                        <a href="{{ url($caminho) }}" class="btn btn-info" ><i class="fa fa-list"></i> Lista</a>
                        @if(!empty($registro->id))
                            <a href="{{ url($caminho.'create') }}" class="btn btn-info" ><i class="fa fa-plus"></i> Novo</a>
                        @endif
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@endsection
