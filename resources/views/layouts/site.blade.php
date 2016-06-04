<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <title>{{ $configuracoes->site_titulo }} - @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{{ asset('assets/img/jr-favicon.png') }}}" rel="shortcut icon" sizes="16x16 32x32 64x64" />
    <meta name="description" content="@yield('pagina_descricao', $configuracoes->descricao)" />
    <meta name="keywords" content="@yield('pagina_palavras_chave', $configuracoes->palavras_chave)" />
    <meta name="author" content="Oni Digital - www.onidigital.com"/>
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="robots" content="index, follow">
    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $configuracoes->site_titulo }} - @yield('title')" />
    <meta property="og:description"   content="@yield('pagina_descricao', $configuracoes->descricao)" />
    <meta property="og:image"         content="@yield('pagina_og_imagem', asset('assets/img/mc-segnorte-og-imagem.png'))" />
    <link rel="canonical" href="{{ url()->current() }}"/>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,300italic,400italic,600italic,700,700italic' rel='stylesheet' type='text/css'>
    {!!Html::style('assets/css/site.min.css')!!}
    @stack('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    @include('site._partes._nav')
    @include('site._partes._erros')
    
    @yield('content')
                    
    @include('site._partes._footer')
    <!-- JavaScripts -->
    {{ HTML::script('assets/js/site.min.js') }}
    @stack('js')
</body>
</html>