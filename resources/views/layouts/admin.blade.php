<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{{ asset('assets/img/favicon.png') }}}" rel="shortcut icon" sizes="16x16 32x32" />
    <meta name="description" content="Gerenciador de Conteúdo" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="robots" content="noindex,nofollow">

    <!-- removido temporariamente pois estamos sem net -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    {!!Html::style('assets/css/admin.min.css')!!}
    @stack('css')

    <title>Admin @yield('title')</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="body">
    <div class="wrapper">
        <div class="sidebar" data-color="oni">
            @include('admin/_partes/sidebar')
        </div>
        <div class="main-panel">
            @include('admin/_partes/nav')
            @include('admin/_partes/erros')
            <div class="content">
                <div class="container-fluid">
                     @yield('content')
                </div>
            </div>
            @include('admin/_partes/footer')
        </div>
    </div>
   <!-- JavaScripts -->
    {{ HTML::script('assets/js/admin.min.js') }}
    @stack('js')
</body>
</html>