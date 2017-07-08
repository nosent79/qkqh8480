@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')
        <div class="">
            <p class="text-center">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#memo" aria-expanded="false" aria-controls="">
                    메모보기
                </button>
            <div class="collapse" id="memo">
                <div class="well">
                    여기는 메모가 들어갈 공간<br />
                </div>
            </div>
            </p>
        </div>

        <div class="">
            <p class="text-center">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="">
                    필터
                </button>
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
                        <option value="asc">마감임박</option>
                    </select>
                    <select class="form-control" name="task_state">
                        <option value="">전체</option>
                        @foreach(config('constants.task')['task_state'] as $k => $v)
                        <option value="{{ $k }}" {{ getSelectedText($k, $params->get('task_state'), 'selected') }}>{{ $v }}</option>
                        @endforeach
                    </select>
                    <div class="pt10">
                        <button class="btn btn-primary" type="submit">조회</button>
                    </div>
                </div>
                </form>
            </div>
            </p>
        </div>

        {{-- 반복문 시작 --}}
        @forelse($tasks as $k => $v)
            @collect($v)

            <div class="thumbnail">
                <a href="{{ route('task.view', ['task_id' => $v->get('task_id') ]) }}">
                    <p class="">{{ $v->get('title') }}</p>
                </a>
            </div>

        @empty
            <div class="thumbnail">
                <span>
                    등록된 태스크가 없습니다. 첫 등록하실래요? <a href="{{ route('task.register') }}">GO</a>
                </span>
            </div>
        @endforelse
        {{--<div class="thumbnail">--}}
            {{--<p class="">가나다라마가나다라마가나다라마가나다라마가나다라마가나다라마</p>--}}
        {{--</div>--}}
    </div>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
@stop

@section('add_js')
    <script src="/js/task.js"></script>
@stop