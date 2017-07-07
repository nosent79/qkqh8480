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
                <button class="btn btn-primary _orderby" type="button" data-href="{{ route('task.index', ['orderby' => 'deadline_date']) }}">
                    정렬 - 마감기한
                </button>
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