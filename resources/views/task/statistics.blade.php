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
                            <label class="col-sm-3 col-lg-1 control-label" for="s_date">시작일자</label>
                            <div class="col-sm-6 col-lg-5">
                                <input class="form-control _datepicker" id="s_date" name="s_date" type="text" placeholder="시작일자" value="{{ $params->get('s_date') }}">
                            </div>
                            <label class="col-sm-3 col-lg-1 control-label" for="e_date">종료일자</label>
                            <div class="col-sm-6 col-lg-5">
                                <input class="form-control _datepicker" id="e_date" name="e_date" type="text" placeholder="종료일자" value="{{ $params->get('e_date') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-1 control-label" for="">상태</label>
                            <div class="col-sm-6 col-lg-11">
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
                    <div>
                        <div class="text-left" style="float:left">
                            <span class="label label-default">{{ $v->get('deposit_date') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="label label-default">{{ $v->get('corp_name') }}</span>
                        </div>
                    </div>
                    <span class="">
                        {{ fnShorten($v->get('title'), 40, '...') }} <br />
                    </span>
                    <div class="text-right">입금액: <span class="bold">{{ number_format($v->get('price')) }}</span> 원</div>
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

    <link href="{{ asset("css/custom.css") }}" rel="stylesheet">
    <link href="{{ asset("css/task.css") }}" rel="stylesheet">
@stop

@section('add_js')
    <script src="{{ asset("js/task.js") }}"></script>
    <script src="{{ asset("js/datepicker.js") }}"></script>
@stop