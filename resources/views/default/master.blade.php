<!DOCTYPE html>
<html lang="ko">
<head>
    @include('default.head')
</head>
<body>
    @yield('body')
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="/jquery/jquery-1.12.4.min.js"></script>
    <script src="/jquery/jquery-ui-1.12.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

    @yield('add_js')
</body>
</html>