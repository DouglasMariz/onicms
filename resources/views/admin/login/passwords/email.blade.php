@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row">                   
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <form class="form" role="form" method="POST" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}
                    <div class="text-center">
                        <img src="/assets/biblioteca/img/logo-oni-white.svg" width="200px">
                    </div>
                    <br>
                    @include('admin/_partes/erros')
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="content">
                            <div class="form-group">
                                <label>Digite seu e-mail</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required >
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-fill btn-info btn-wd btn-block">Enviar link para alteração de senha</button>
                            <a href="{{ url('auth/login') }}" class="small">Voltar</a>
                        </div>
                    </div> 
                </form>
            </div>                    
        </div>
    </div>
@endsection
