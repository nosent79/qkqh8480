@section('metatag')
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
@show

@section('title')
    <title>@yield('title', config('app.title'))</title>
@show

@section('css')
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- 부가적인 테마 -->
    {{--<link href="/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">--}}

    <link href="{{ asset('jquery/jquery-ui.min.css') }}" rel="stylesheet">
@show

@section('script')
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{{ asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <script src="{{ asset('js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
@show

