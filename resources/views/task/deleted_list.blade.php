@extends('default.master')
@section('body')
    <div class="container">
        @include('default.nav')

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
                    삭제된 태스크가 없습니다.
                </span>
            </div>
        @endforelse
    </div>
@stop

@section('css')
    @parent

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@stop

@section('add_js')
    <script src="{{ asset('js/task.js') }}"></script>
@stop