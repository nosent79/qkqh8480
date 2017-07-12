@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>메모 등록</small></h1>
            </div>
            <form id="frmTask" name="frmTask" class="form-horizontal" method="post" action="{{ route('memo.register_ok') }}">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="memo">메모</label>
                    <div class="col-sm-6">
                        <textarea id="memo" name="memo" class="form-control" rows="5">{{ $memo->get('memo') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">등록 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        <button class="btn btn-default _btn_list" type="button" data-href="{{ route('task.index') }}">초기화면 <span class="glyphicon glyphicon-list" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>
@stop

@section('css')
    @parent

    <link href="{{ asset("css/custom.css") }}" rel="stylesheet">
@stop

@section('add_js')
    <script src="{{ asset("js/validator.js") }}"></script>
    <script src="{{ asset("js/memo.js") }}"></script>
    <script>
        function init()
        {
            var task_state = $('input:radio[name=task_state]');

            if (! task_state.is(':checked')) {
                task_state.eq(0).attr("checked", true);
            }
        }

        $(document).ready(function() {
            init();
        });

        $(function() {
            $("#frmMemo").submit(function() {
                var task_type = $('input:radio[name=task_type]');
                var task_state = $('input:radio[name=task_state]');

                // 태스크 타입 체크
                if (! task_type.is(':checked')) {
                    alert('구분을 선택하세요.');

                    return false;
                }

                // 상태 체크
                if (! task_state.is(':checked')) {
                    alert('상태를 체크하세요');

                    return false;
                }

                // 마감기한 체크
                if (! checkDateFormat($("#deadline_date").val())) {
                    return false;
                }

                if (task_type.val() === "price") {
                    if (! checkDateFormat($("#deposit_date").val())) {
                        return false;
                    }
                }

                return true;
            });
        });

        function checkDateFormat(date)
        {
            var dayRegExp = /^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/;

            return dayRegExp.test(date);
        }
    </script>
@stop