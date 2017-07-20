@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="">
            <p class="text-center">
                <button class="btn btn-default _btn_memo" type="button" data-toggle="collapse" data-target="#memo" aria-expanded="false" aria-controls="">
                    메모
                </button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="">
                    필터
                </button>
                <button class="btn btn-success _btn_register" type="button" data-href="{{ route('task.register') }}">
                    등록
                </button>
            </p>
            <div class="collapse" id="memo">
                <div class="well _memo"></div>
            </div>
        </div>

        <div class="">
            <div class="collapse" id="filter">
                <form id="frmSearch" name="frmSearch" class="form-horizontal" method="get" action="{{ route('task.index') }}">
                <div class="well">
                    {{--<select class="form-control" name="orderby[reg_date]">--}}
                        {{--<option value="">전체</option>--}}
                        {{--<option value="asc">과거기준</option>--}}
                        {{--<option value="desc"></option>--}}
                    {{--</select>--}}
                    <h4>정렬구분</h4>
                    <select class="form-control" name="orderby[deadline_date]">
                        {{--<option value="desc">마감</option>--}}
                        <option value="asc">마감임박순</option>
                    </select>
                    <h4>타입구분</h4>
                    <select class="form-control" name="task_type">
                        <option value="">전체</option>
                        @foreach(config('constants.task')['task_type'] as $k => $v)
                            <option value="{{ $k }}" {{ getSelectedText($k, $params->get('task_type'), 'selected') }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    <h4>상태구분</h4>
                    <select class="form-control" name="task_state">
                        <option value="">전체</option>
                        @foreach(config('constants.task')['task_state'] as $k => $v)
                        <option value="{{ $k }}" {{ getSelectedText($k, $params->get('task_state'), 'selected') }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    <div class="pt10 text-right">
                        <button class="btn btn-primary" type="submit">조회</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        {{-- 반복문 시작 --}}
        @forelse($tasks as $k => $v)
            @collect($v)
                <div class="thumbnail">
                    <a href="{{ route('task.view', ['task_id' => $v->get('task_id') ]) }}">
                    <div>
                        <div class="text-left" style="float:left">
                            <span class="label label-default">{{ $v->get('deadline_date') }}</span>
                            <span class="label label-default">{{ config('constants.task')['task_type'][$v->get('task_type')] }}</span>
{{--                            <span class="label label-default">{{ $v->get('corp_name') }}</span>--}}
                            @if (in_array($v->get('task_state'), ['w', 'dc', 'wc']))
                            <span class="label label-default">{{ config('constants.task')['task_state'][$v->get('task_state')] }}</span>
                            @elseif ($v->get('task_state') === 'cw')
                            <span class="label label-primary">{{ config('constants.task')['task_state'][$v->get('task_state')] }}</span>
                            @elseif ($v->get('task_state') === 'dw')
                            <span class="label label-warning">{{ config('constants.task')['task_state'][$v->get('task_state')] }}</span>
                            @endif
                        </div>
                        <div class="text-right">
                            @if (in_array($v->get('task_state'), ['w']))
                                @if (fnDiffRemainDays($v->get('deadline_date'))['days'] < 0)
                                    <span class="label label-default">{{ fnDiffRemainDays($v->get('deadline_date'))['msg'] }}</span>
                                @elseif (fnDiffRemainDays($v->get('deadline_date'))['days'] <= 3)
                                    <span class="label label-danger">{{ fnDiffRemainDays($v->get('deadline_date'))['msg'] }}</span>
                                @else
                                    <span class="label label-success">{{ fnDiffRemainDays($v->get('deadline_date'))['msg'] }}</span>
                                @endif
                            @else
                                <span class="">&nbsp;</span>
                            @endif
                        </div>
                    </div>
                    {{ fnShorten($v->get('title'), 40, '...') }}
                    </a>
                </div>

        @empty
            <div class="thumbnail">
                <span>
                    등록된 태스크가 없습니다. 첫 등록하실래요? <a href="{{ route('task.register') }}">GO</a>
                </span>
            </div>
        @endforelse
        <div class="text-center">
            {!! $tasks->appends([
                                'orderby[deadline_date]' => $params->get('orderby')['deadline_date'],
                                'task_state' => $params->get('task_state'),
                                'task_type' => $params->get('task_type')
                                ])->render() !!}
        </div>
    </div>
@stop

@section('css')
    @parent

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@stop

@section('add_js')
    <script src="{{ asset('js/task.js') }}"></script>
    <script>
        // 브라우저 버전 체크
        function checkBrowserType() {
            var agt = navigator.userAgent.toLowerCase();

            if (agt.indexOf("msie") != -1) {
                var trident = navigator.userAgent.match(/Trident\/(\d.\d)/i);

                if(trident == null){
                    return false;
                } else if(trident[1] != "4.0") {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
        $("._btn_memo").click(function () {
            var bExpanded = $(this).attr("aria-expanded");

            if (bExpanded === "false") {
                var url = "{{ route('memo.view') }}";
                $.ajax({
                    type: 'get',
                    dataType: 'text',
                    url: url,
                    data: {},
                    success: function (data) {
                        var json = JSON.parse(data);
                        console.log(json.memo);
                        $("._memo").html(json.memo);
                    },
                    error: function () {

                    }
                });
            }
        });
    </script>
@stop