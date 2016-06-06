@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="header">
                <h4 class="title">{{ $titulo }} <small> Lista</small></h4>
                <a href="{{ url($caminho.'create') }}" class="btn btn-wd btn-info"><span class="btn-label"><i class="fa fa-plus"></i></span> Novo</a>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped" data-toggle="table" data-id-field="id">
                    <thead>
                    <tr>
                        <th data-checkbox="true">&nbsp;</th>
                        <th data-field="id" data-sortable="true" >ID</th>
                        <th data-field="nome" data-sortable="true" >Nome</th>
                        <th data-field="url" data-sortable="true" >Destino</th>
                        <th data-field="peso" data-sortable="true" >Peso</th>
                        <th data-click-to-select="false" data-align="center" data-searchable="false">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td></td>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->url }}</td>
                            <td>{{ $registro->peso }}</td>
                            <td>
                                @include('admin/_partes/_botoes_acao')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- content -->
        </div><!-- card -->
    </div><!-- col -->
</div><!-- row -->
@endsection
