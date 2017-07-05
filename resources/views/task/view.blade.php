@extends('default.master')
@section('body')
    <article>
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>태스크 등록</small></h1>
            </div>
            <form id="frmTask" name="frmTask" class="form-horizontal" method="post" action="{{ route('task.register_ok') }}">
                <input type="hidden" id="task_type" name="task_type" required />
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">구분</label>
                    <div class="col-sm-6">
                        <div class="btn-group btn-group-justified" role="group" aria-label="태스크 구분">
                            <div class="btn-group" role="group">
                                <button type="button" data-type='product' class="btn btn-default _task_type">제품</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">태스크명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="title" name="title" type="text" placeholder="태스크명" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">상태</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            <label class="_ts"><input type="radio" name="task_state" id="task_state_1" value="w" checked>대&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;기</label>
                            <label class="_ts"><input type="radio" name="task_state" id="task_state_2" value="cw">컨펌대기</label>
                            <label class="_ts"><input type="radio" name="task_state" id="task_state_3" value="dw">입금대기</label>
                            <label class="_ts"><input type="radio" name="task_state" id="task_state_4" value="dw">입금완료</label>
                            <label class="_ts"><input type="radio" name="task_state" id="task_state_5" value="wc">작업완료</label>
                            <label class="_ts"><input type="radio" name="task_state" id="task_state_6" value="d">삭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;제</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="deadline_date">마감기한</label>
                    <div class="col-sm-6">
                        <input class="form-control _datepicker" id="deadline_date" name="deadline_date" type="text" placeholder="마감기한">
                    </div>
                </div>
                <div id="task_price" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="price">금액</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="price" name="price" type="number" placeholder="금액">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="deposit_date">입금일자</label>
                        <div class="col-sm-6">
                            <input class="form-control _datepicker" id="deposit_date" name="deposit_date" type="text" placeholder="입금일자">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="corp_name">업체명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="corp_name" name="corp_name" type="text" placeholder="업체명">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">중요도</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            <label class="_tp"><input type="radio" name="priority" id="priority_1" value="a" checked>긴급</label>
                            <label class="_tp"><input type="radio" name="priority" id="priority_2" value="b">높음</label>
                            <label class="_tp"><input type="radio" name="priority" id="priority_3" value="c">중간</label>
                            <label class="_tp"><input type="radio" name="priority" id="priority_4" value="d">낮음</label>
                        </div>
                    </div>
                </div>
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
                        <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">등록 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        <button class="btn btn-default" type="button">리스트 <span class="glyphicon glyphicon-list" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </article>
@stop