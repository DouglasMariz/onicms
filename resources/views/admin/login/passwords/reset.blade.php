@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">                   
        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <form class="form" role="form" method="POST" action="{{ url('/password/reset') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
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
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" autofocus required>
                        </div>
                        <div class="form-group">
                            <label>Nova senha</label>
                            <input type="password" class="form-control" name="password" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Confirme a nova senha</label>
                            <input type="password" class="form-control" name="password_confirmation" value="" required>
                        </div>
                    </div>
                    <div class="footer text-center">
                        <button type="submit" class="btn btn-fill btn-info btn-wd btn-block">Gravar a nova senha</button>
                        <a href="{{ url('auth/login') }}" class="small">Cancelar</a>
                    </div>
                </div> 
            </form>
        </div>                    
    </div>
</div>
@endsection
