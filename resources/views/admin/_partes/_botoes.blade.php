<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="content text-right">
                    <a href="{{ url($caminho) }}" class="btn btn-info" ><i class="fa fa-list"></i> Lista</a>
                    @if(!empty($registro->id))
                        <a href="{{ url($caminho.'create') }}" class="btn btn-info" ><i class="fa fa-plus"></i> Novo</a>
                    @endif
                    {!! Form::submit('Gravar', ['class' => 'btn btn-fill btn-wd btn-success']) !!}
            </div>
        </div>
    </div>
</div>