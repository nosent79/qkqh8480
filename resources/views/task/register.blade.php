@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>태스크 등록</small></h1>
            </div>
            <form id="frmTask" name="frmTask" class="form-horizontal" method="post" action="{{ route('task.register_ok') }}">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">구분</label>
                    <div class="col-sm-6 text-center" data-toggle="buttons">
                        <label class="btn btn-default _task_type" style="width:49%;">
                            <input name="task_type" type="radio" value="product" />
                            <span class="fa fa-check"></span>&nbsp;제품
                        </label>
                        <label class="btn btn-default _task_type" style="width:49%;">
                            <input name="task_type" type="radio" value="price" />
                            <span class="fa fa-check"></span>&nbsp;원고료
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">태스크명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="title" name="title" type="text" placeholder="태스크명" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">상태</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            @foreach(config('constants.task')['task_state'] as $k => $v)
                                <label class="_ts"><input type="radio" name="task_state" value="{{ $k }}">{{ $v }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="deadline_date">마감기한</label>
                    <div class="col-sm-6">
                        <input class="form-control _datepicker" id="deadline_date" name="deadline_date" type="text" placeholder="마감기한">
                    </div>
                </div>
                <div id="task_price" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="price">금액</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="price" name="price" type="number" placeholder="금액">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="deposit_date">입금일자</label>
                        <div class="col-sm-6">
                            <input class="form-control _datepicker" id="deposit_date" name="deposit_date" type="text" placeholder="입금일자">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="corp_name">업체명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="corp_name" name="corp_name" type="text" placeholder="업체명">
                    </div>
                </div>
                {{-- 중요도 제거 2017-07-08 --}}
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label" for="">중요도</label>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="radio">--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="a" checked>긴급</label>--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="b">높음</label>--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="c">중간</label>--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="d">낮음</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="blog_url">Blog URL</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="tel" class="form-control" id="blog_url" name="blog_url" placeholder="블로그 주소를 불러옵니다." />
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button">조회 <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </div>
                </div>
                --}}
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="comment">비고</label>
                    <div class="col-sm-6">
                        <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">등록 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        <button class="btn btn-default _btn_list" type="button" data-href="{{ route('task.index') }}">리스트 <span class="glyphicon glyphicon-list" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/task.css" rel="stylesheet">
@stop

@section('add_js')
    <script src="/js/validator.js"></script>
    <script src="/js/task.js"></script>
    <script src="/js/datepicker.js"></script>
    {{--<script src="/js/validator_event.js"></script>--}}
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

            $("._task_type").click(function () {
                var flag = $(this).children('input').val();
                var type = $('input:radio[name=task_type]:input[value=' + flag + ']').attr("checked", true).val();

                if (type === "product") {
                    $("#task_price").hide();
                } else {
                    $("#task_price").show();
                }
                $("#task_type").val(type);
            });
        });

        $(function() {
            $("#frmTask").submit(function() {
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