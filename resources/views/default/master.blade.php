<!DOCTYPE html>
<html lang="ko">
<head>
    @include('default.head')
</head>
<body>
    @yield('body')
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    @yield('add_js')
</body>
</html>