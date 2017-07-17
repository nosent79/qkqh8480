@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>태스크 수정</small></h1>
            </div>
            <form id="frmTask" name="frmTask" class="form-horizontal" method="post" action="{{ route('task.modify_ok') }}">
                <input type="hidden" name="task_id" value="{{ $params->get('task_id') }}" />
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
                        <input class="form-control" id="title" name="title" type="text" placeholder="태스크명" required value="{{ $params->get('title') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">상태</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            @foreach(config('constants.task')['task_state'] as $k => $v)
                                <label class="_ts"><input type="radio" name="task_state" value="{{ $k }}" {{ getSelectedText($params->get('task_state'), $k, 'checked') }}>{{ $v }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="deadline_date">마감기한</label>
                    <div class="col-sm-6">
                        <input class="form-control _datepicker" id="deadline_date" name="deadline_date" type="text" placeholder="마감기한" value="{{ fnParseDate($params->get('deadline_date')) }}">
                    </div>
                </div>
                <div id="task_price" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="price">금액</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="price" name="price" type="number" placeholder="금액" value="{{ $params->get('price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="deposit_date">입금일자</label>
                        <div class="col-sm-6">
                            <input class="form-control _datepicker" id="deposit_date" name="deposit_date" type="text" placeholder="입금일자" value="{{ fnParseDate($params->get('deposit_date')) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="corp_name">업체명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="corp_name" name="corp_name" type="text" placeholder="업체명" value="{{ $params->get('corp_name') }}">
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label" for="">중요도</label>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="radio">--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="a" {{ getSelectedText($params->get('priority'), 'a', 'checked') }}>긴급</label>--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="b" {{ getSelectedText($params->get('priority'), 'b', 'checked') }}>높음</label>--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="c" {{ getSelectedText($params->get('priority'), 'c', 'checked') }}>중간</label>--}}
                            {{--<label class="_tp"><input type="radio" name="priority" value="d" {{ getSelectedText($params->get('priority'), 'd', 'checked') }}>낮음</label>--}}
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
                        <textarea id="comment" name="comment" class="form-control" rows="3">{{ $params->get('comment') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        @if ($params->get('task_state') !== 'd')
                        <button class="btn btn-primary" type="submit">등록 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        @endif
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

    <link href="{{ asset("css/custom.css") }}" rel="stylesheet">
    <link href="{{ asset("css/task.css") }}" rel="stylesheet">
@stop

@section('add_js')
    <script src="{{ asset("js/validator.js") }}"></script>
    <script src="{{ asset("js/task.js") }}"></script>
    <script src="{{ asset("js/datepicker.js") }}"></script>
    <script>
        var type = "{{ $params->get('task_type') }}";
        _init(type);

        $(function() {
            $("#frmTask").submit(function() {
                var task_type = $('input:radio[name=task_type]');
                var task_state = $('input:radio[name="task_state"]:checked').val();

                // 태스크 타입 체크
                if (! task_type.is(':checked')) {
                    alert('구분을 선택해주세요');

                    return false;
                }

                // 마감기한 체크
                if (! checkDateFormat($("#deadline_date").val())) {
                    alert('마감기한을 선택해주세요');

                    return false;
                }

                if ($('input:radio[name="task_type"]:checked').val() === "price" && task_state === 'dc') {
                    if (! checkDateFormat($("#deposit_date").val())) {
                        alert("입금일자를 선택해주세요");

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