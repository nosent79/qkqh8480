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
    </div>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
@stop

@section('add_js')
@stop