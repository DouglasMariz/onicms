@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row">                   
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <form role="form" method="POST" action="{{ url('/admin/login') }}">
                {!! csrf_field() !!}
                    <div class="text-center">
                        {{ Html::image('/assets/admin/img/logo-oni-white.svg', 'Oni Digital', array('width'=>'200px')) }}
                    </div>
                    <br>
                    @include('admin/_partes/erros')
                    <div class="card">
                        <div class="content">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="seu@email.com.br" required autofocus >
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" placeholder="******" name="password" class="form-control" required >
                            </div>                                    
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-fill btn-info btn-wd btn-block">Login</button>
                            <a href="{{ url('admin/password/reset') }}" class="small" >Esqueci a senha</a>
                        </div>
                    </div> 
                </form>
            </div>                    
        </div>
    </div>
@endsection