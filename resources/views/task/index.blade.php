@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="">
            <p class="text-center">
                <button class="btn btn-default _btn_memo" type="button" data-toggle="collapse" data-target="#memo" aria-expanded="false" aria-controls="">
                    메모보기
                </button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="">
                    필터
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
                    <select class="form-control" name="orderby[deadline_date]">
                        {{--<option value="desc">마감</option>--}}
                        <option value="asc">마감임박순</option>
                    </select>
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
                    <div>
                        <div class="text-left" style="float:left">
                            <span class="label label-default">{{ $v->get('deadline_date') }}</span>
                            <span class="label label-default">{{ $v->get('corp_name') }}</span>
                            <span class="label label-default">{{ config('constants.task')['task_state'][$v->get('task_state')] }}</span>
                        </div>
                        <div class="text-right">
                            @if (fnDiffRemainDays($v->get('deadline_date')) <= 3)
                                <span class="label label-danger">{{ fnDiffRemainDays($v->get('deadline_date')) }}</span>
                            @else
                                <span class="label label-success">{{ fnDiffRemainDays($v->get('deadline_date')) }}</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('task.view', ['task_id' => $v->get('task_id') ]) }}">
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
            {!! $tasks->render() !!}
        </div>
    </div>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
@stop

@section('add_js')
    <script src="/js/task.js"></script>
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