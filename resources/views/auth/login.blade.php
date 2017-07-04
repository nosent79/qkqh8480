@extends('default.master')
@section('body')
    <div class="container">
        <form class="form-signin" method="post" action="{{ route('auth.login_ok') }}">
            <h2 class="form-signin-heading">로그인</h2>
            <label for="user_id" class="sr-only">Email address</label>
            <input type="text" id="user_id" name="user_id" class="form-control" placeholder="아이디" required autofocus>
            <label for="user_pwd" class="sr-only">Password</label>
            <input type="password" id="user_pwd" name="user_pwd" class="form-control" placeholder="비밀번호" required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="save_user_id" name="save_user_id" value="remember-me"> 아이디 저장
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>
        </form>
    </div> <!-- /container -->
@stop
@section('add_js')
    <script>
    $(document).ready(function() {
        // 저장된 쿠키값을 가져와서 ID 칸에 넣어준다. 없으면 공백으로 들어감.
        var user_id = getCookie("user_id");
        if (user_id) {
            $("#save_user_id").attr("checked", true);
            $("#user_id").val(user_id);
        }

        $("#save_user_id").change(function() {
            if ($("#save_user_id").is(":checked")) {
                var userInputId = $("input[name='user_id']").val();
                setCookie("user_id", userInputId, 7);
            } else { // ID 저장하기 체크 해제 시,
                deleteCookie("user_id");
            }
        });

        // ID 저장하기를 체크한 상태에서 ID를 입력하는 경우, 이럴 때도 쿠키 저장.
        $("input[name='user_id']").keyup(function() {
            if ($("#save_user_id").is(":checked")) {
                var userInputId = $("input[name='user_id']").val();
                setCookie("user_id", userInputId, 7);
            }
        });
    });

    function setCookie(cookieName, value, exdays)
    {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var cookieValue = encodeURI(value) + ((exdays==null) ? "" : "; expires=" + exdate.toGMTString());
        document.cookie = cookieName + "=" + cookieValue;
    }

    function deleteCookie(cookieName)
    {
        var expireDate = new Date();
        expireDate.setDate(expireDate.getDate() - 1);
        document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
    }

    function getCookie(cookieName)
    {
        cookieName = cookieName + '=';
        var cookieData = document.cookie;
        var start = cookieData.indexOf(cookieName);
        var cookieValue = '';
        if (start != -1) {
            start += cookieName.length;
            var end = cookieData.indexOf(';', start);
            if (end == -1) {
                end = cookieData.length;
            }
            cookieValue = cookieData.substring(start, end);
        }

        return decodeURI(cookieValue);
    }
    </script>
@stop