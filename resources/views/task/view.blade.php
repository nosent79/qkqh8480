@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>태스크 상세</small></h1>
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    @include('task.task_template')
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">태스크명</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" readonly="readonly" value="{{ $params->get('title') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">상태</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            @foreach(config('constants.task')['task_state'] as $k => $v)
                                <label class="_ts"><input type="radio" name="task_state" value="{{ $k }}" {{ getSelectedText($params->get('task_state'), $k, 'checked') }} disabled="true">{{ $v }}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="deadline_date">마감기한</label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" value="{{ $params->get('deadline_date') }}" readonly="readonly">
                    </div>
                </div>
                <div id="task_price" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="price">금액</label>
                        <div class="col-sm-6">
                            <input class="form-control" value="{{ number_format($params->get('price')) }}" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="deposit_date">입금일자</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" value="{{ $params->get('deposit_date') }}" readonly="readonly">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="corp_name">업체명</label>
                    <div class="col-sm-6">
                        <input class="form-control" value="{{ $params->get('corp_name') }}" readonly="readonly">
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label" for="">중요도</label>--}}
                    {{--<div class="col-sm-6">--}}
                        {{--<div class="radio">--}}
                            {{--<label class="_tp"><input type="radio" value="a" {{ getSelectedText($params->get('priority'), 'a', 'checked') }} disabled="true">긴급</label>--}}
                            {{--<label class="_tp"><input type="radio" value="b" {{ getSelectedText($params->get('priority'), 'b', 'checked') }} disabled="true">높음</label>--}}
                            {{--<label class="_tp"><input type="radio" value="c" {{ getSelectedText($params->get('priority'), 'c', 'checked') }} disabled="true">중간</label>--}}
                            {{--<label class="_tp"><input type="radio" value="d" {{ getSelectedText($params->get('priority'), 'd', 'checked') }} disabled="true">낮음</label>--}}
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
                        <textarea class="form-control" rows="3" readonly="readonly">{{ $params->get('comment') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3 text-center"></div>
                    <div class="col-sm-6 text-center">
                    @if ($params->get('task_state') !== 'd')
                        <button class="btn btn-danger _btn_delete" type="button" data-href="{{ route('task.delete', ['task_id' => $params->get('task_id')]) }}">삭제 <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        <button class="btn btn-warning _btn_modify" type="button" data-href="{{ route('task.modify', [
                            'task_id' => $params->get('task_id'),
                            'task_state' => $params->get('task_state')
                        ]) }}">수정 <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
                    @endif
                        <button class="btn btn-primary _btn_register" type="button" data-href="{{ route('task.register') }}">신규 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                        <button class="btn btn-default _btn_list" type="button" data-href="{{ route('task.index') }}">리스트 <span class="glyphicon glyphicon-list" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('css')
    @parent

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/task.css') }}" rel="stylesheet">
@stop

@section('add_js')
    <script src="{{ asset('js/task.js') }}"></script>
    <script>
        var type = "{{ $params->get('task_type') }}";
        _init(type);
    </script>
@stop