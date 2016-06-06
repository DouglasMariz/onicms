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
                        {!! Form::label('nome', 'Nome:') !!}
                        {!! Form::text('nome', null, ['class' => 'form-control', 'autofocus'] ) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('url', 'URL de destino:') !!}
                        {!! Form::select('url', $rotas_disponiveis, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('parent_id', 'Dentro de:') !!}
                        {!! Form::select('parent_id', $menus, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group" >
                        <div class="row" >
                            <div class="col-sm-6">
                                {!! Form::label('icone', 'Ícone:') !!}
                                {!! Form::text('icone', null, ['class' => 'form-control', 'placeholder'=> 'Digite o nome da classe do ícone'] ) !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::label('peso', 'Peso:') !!}
                                {!! Form::number('peso', null, ['class' => 'form-control'] ) !!}
                            </div>
                        </div>
                    </div>

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
