@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>비밀번호 변경</small></h1>
            </div>
            <form id="frmPassword" name="frmPassword" class="form-horizontal" method="post" action="{{ route('member.change_password_ok') }}">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">기존 비밀번호</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="old_pwd" name="old_pwd" type="password" placeholder="기존 비밀번호" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">변경 비밀번호</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="new_pwd" name="new_pwd" type="password" placeholder="변경 비밀번호" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">변경 비밀번호 확인</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="new_pwd_re" name="new_pwd_re" type="password" placeholder="변경 비밀번호 확인" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">변경 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        <button class="btn btn-default _btn_list" type="button" data-href="{{ route('task.index') }}">초기화면 <span class="glyphicon glyphicon-list" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
@stop

@section('add_js')
    <script src="/js/validator.js"></script>
    <script>
        $(document).ready(function() {
            $("._btn_list").click(function () {
                var url = $("._btn_list").data('href');
                location.href = url;
            });

            $("#frmPassword").submit(function() {
                if (validate.compareTextValue($("#new_pwd"), $("#new_pwd_re"), "비밀번호가 일치하지 않습니다.")) {

                    return false;
                }

                return true;
            });
        });
    </script>
@stop