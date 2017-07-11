@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')

        <div class="">
            <p class="text-right">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="">
                    필터
                </button>
            </p>
            <div class="collapse" id="filter">

                <div class="well">
                    <form id="frmSearch" name="frmSearch" class="form-horizontal" method="get" action="{{ route('task.statistics') }}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="s_date">시작일자</label>
                            <div class="col-sm-6">
                                <input class="form-control _datepicker" id="s_date" name="s_date" type="text" placeholder="시작일자" value="{{ $params->get('s_date') }}">
                            </div>
                            <label class="col-sm-3 control-label" for="e_date">종료일자</label>
                            <div class="col-sm-6">
                                <input class="form-control _datepicker" id="e_date" name="e_date" type="text" placeholder="종료일자" value="{{ $params->get('e_date') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="">상태</label>
                            <div class="col-sm-6">
                                <div class="radio">
                                    <label class="_ts"><input type="radio" name="task_state" value="all" {{ getSelectedText($params->get('task_state'), 'all', 'checked') }}>전체</label>
                                    @foreach(config('constants.task')['task_state'] as $k => $v)
                                        <label class="_ts"><input type="radio" name="task_state" value="{{ $k }}" {{ getSelectedText($params->get('task_state'), $k, 'checked') }}>{{ $v }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button class="btn btn-primary" type="submit">조회</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{--반복문 시작--}}
            <div class="well text-right">
                <span>{{ "총 ". $tasks->count() . "건, 총 " . number_format($tasks->sum('price')) . "원 입니다." }}</span>
            </div>

            @forelse($tasks as $k => $v)
                @collect($v)
                <div class="thumbnail">
                    {{ fnParseDateToKor($v->get('deposit_date')) }} <br />
                    {{ $v->get('corp_name') }} <br />
                    <span class="">
                        {{ $v->get('title') }} <br />
                    </span>
                    {{ number_format($v->get('price')) }}
                </div>
            @empty
            @endforelse

            <div class="text-center">
                {!! $tasks->appends(['task_state' => $params->get('task_state')])->render() !!}
            </div>
        </div>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/task.css" rel="stylesheet">
@stop

@section('add_js')
    <script src="/js/task.js"></script>
    <script src="/js/datepicker.js"></script>
@stop