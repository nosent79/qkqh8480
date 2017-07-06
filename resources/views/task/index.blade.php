@extends('default.master')
@section('body')
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('/') }}">{{ config('app.title') }}</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <!-- Begin page content -->
    <div class="container">
        <div class="page-header">
            <h1>Sticky footer with fixed navbar</h1>
        </div>
        <div class="">
            <p class="text-center">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#memo" aria-expanded="false" aria-controls="">
                    메모보기
                </button>
            <div class="collapse" id="memo">
                <div class="well">
                    여기는 메모가 들어갈 공간<br />
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                    여기는 메모가 들어갈 공간
                </div>
            </div>
            </p>
        </div>
    </div>

    <footer class="footer">
        <div class="container text-center">
            <p class="text-muted">Copyright © 2017. qkqh8480. All rights reserved.</p>
        </div>
    </footer>
@stop

@section('css')
    @parent

    <link href="/css/custom.css" rel="stylesheet">
@stop

@section('add_js')
@stop