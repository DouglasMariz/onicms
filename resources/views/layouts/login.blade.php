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


    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    {!!Html::style('assets/admin/css/admin.min.css')!!}
    @stack('css')
    

    <title>Login @yield('title')</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="body" class="login-index">
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page">   
            <div class="content">
                @yield('content')
            </div>  
        </div>
    </div>
    <!-- JavaScripts -->
    {{ HTML::script('assets/admin/js/admin.min.js') }}
    @stack('js')
</body>
</html>