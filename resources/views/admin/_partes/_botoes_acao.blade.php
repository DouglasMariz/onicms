<div class="btn-group" role="group" aria-label="botoes-acao">
    {!! Form::open(['method' => 'DELETE', 'url'=> "$caminho$registro->id", 'class' => "form-inline"]) !!}
    	<a href="{{ url($caminho.$registro->id.'') }}" class="btn btn-xs btn-fill btn-warning" title="Editar este registro" data-toggle="tooltip"><span class="btn-label"><i class="ion-ios-minus"></i> Editar</span></a>
		<button type="submit" class="btn btn-xs btn-fill btn-danger" onclick="return confirm('Tem certeza?')"  title="Cuidado!" data-toggle="tooltip"><span class="btn-label"><i class="ion-ios-close"></i> Excluir</span></button>
	{!! Form::close() !!}
</div>