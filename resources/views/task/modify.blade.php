@extends('default.master')
@section('body')
    <article>
        <div class="col-md-12">
            <div class="page-header text-center">
                <h1><small>태스크 수정</small></h1>
            </div>
            <form id="frmTask" name="frmTask" class="form-horizontal" method="post" action="{{ route('task.modify_ok') }}">
                <input type="hidden" name="task_id" value="{{ $params->get('task_id') }}" />
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">구분</label>
                    <div class="col-sm-6 text-center" data-toggle="buttons">
                        <label class="btn btn-default _task_type" style="width:49%;">
                            <input name="task_type" type="radio" value="product" />
                            <span class="fa fa-check"></span>&nbsp;제품
                        </label>
                        <label class="btn btn-default _task_type" style="width:49%;">
                            <input name="task_type" type="radio" value="price" />
                            <span class="fa fa-check"></span>&nbsp;원고료
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="title">태스크명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="title" name="title" type="text" placeholder="태스크명" required value="{{ $params->get('title') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">상태</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            <label class="_ts"><input type="radio" name="task_state" value="w" {{ getSelectedText($params->get('task_state'), 'w', 'checked') }}>대&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;기</label>
                            <label class="_ts"><input type="radio" name="task_state" value="cw" {{ getSelectedText($params->get('task_state'), 'cw', 'checked') }}>컨펌대기</label>
                            <label class="_ts"><input type="radio" name="task_state" value="dw" {{ getSelectedText($params->get('task_state'), 'dw', 'checked') }}>입금대기</label>
                            <label class="_ts"><input type="radio" name="task_state" value="dc" {{ getSelectedText($params->get('task_state'), 'dc', 'checked') }}>입금완료</label>
                            <label class="_ts"><input type="radio" name="task_state" value="wc" {{ getSelectedText($params->get('task_state'), 'wc', 'checked') }}>작업완료</label>
                            <label class="_ts"><input type="radio" name="task_state" value="d" {{ getSelectedText($params->get('task_state'), 'd', 'checked') }}>삭&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;제</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="deadline_date">마감기한</label>
                    <div class="col-sm-6">
                        <input class="form-control _datepicker" id="deadline_date" name="deadline_date" type="text" placeholder="마감기한" value="{{ fnParseDate($params->get('deadline_date')) }}">
                    </div>
                </div>
                <div id="task_price" style="display:none">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="price">금액</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="price" name="price" type="number" placeholder="금액" value="{{ number_format($params->get('price')) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="deposit_date">입금일자</label>
                        <div class="col-sm-6">
                            <input class="form-control _datepicker" id="deposit_date" name="deposit_date" type="text" placeholder="입금일자" value="{{ fnParseDate($params->get('deposit_date')) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="corp_name">업체명</label>
                    <div class="col-sm-6">
                        <input class="form-control" id="corp_name" name="corp_name" type="text" placeholder="업체명" value="{{ $params->get('corp_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="">중요도</label>
                    <div class="col-sm-6">
                        <div class="radio">
                            <label class="_tp"><input type="radio" name="priority" value="a" {{ getSelectedText($params->get('priority'), 'a', 'checked') }}>긴급</label>
                            <label class="_tp"><input type="radio" name="priority" value="b" {{ getSelectedText($params->get('priority'), 'b', 'checked') }}>높음</label>
                            <label class="_tp"><input type="radio" name="priority" value="c" {{ getSelectedText($params->get('priority'), 'c', 'checked') }}>중간</label>
                            <label class="_tp"><input type="radio" name="priority" value="d" {{ getSelectedText($params->get('priority'), 'd', 'checked') }}>낮음</label>
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
                        <textarea id="comment" name="comment" class="form-control" rows="3">{{ $params->get('comment') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        @if ($params->get('task_state') !== 'd')
                        <button class="btn btn-primary" type="submit">등록 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                        @endif
                        <button class="btn btn-default _btn_list" type="button" data-href="{{ route('task.index') }}">리스트 <span class="glyphicon glyphicon-list" aria-hidden="true"></span></button>
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </article>
@stop

@section('css')
    @parent

    <link href="/css/task.css" rel="stylesheet">
@stop

@section('add_js')
    <script src="/js/validator.js"></script>
    <script src="/js/task.js"></script>
    <script>
        var type = "{{ $params->get('task_type') }}";
        init(type);

        function cleanDatepicker() {        //datepicker 삭제 버튼
            var old_fn = $.datepicker._updateDatepicker;

            $.datepicker._updateDatepicker = function(inst) {
                old_fn.call(this, inst);

                var buttonPane = $(this).datepicker("widget").find(".ui-datepicker-buttonpane");

                $("<button type='button' class='ui-datepicker-clean ui-state-default ui-priority-primary ui-corner-all'>clear</button>").appendTo(buttonPane).click(function(ev) {
                    $.datepicker._clearDate(inst.input);
                }) ;
            }
        }

        $(document).ready(function() {
        });

        $(function() {
            cleanDatepicker();

            $("._datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $.datepicker.regional['ko'] = {
                closeText: '닫기',
                showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다.
                prevText: '이전',
                nextText: '다음',
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                dayNames: ['일','월','화','수','목','금','토'],
                dayNamesShort: ['일','월','화','수','목','금','토'],
                dayNamesMin: ['일','월','화','수','목','금','토'],
                weekHeader: 'Wk',
                dateFormat: 'yy-mm-dd',
                firstDay: 0,
                isRTL: false,
                changeMonth: true,
                changeYear: true,
                showMonthAfterYear: true,
                yearRange: 'c-99:c+99',
                yearSuffix: ''
            };

            $.datepicker.setDefaults($.datepicker.regional['ko']);

            $("#frmTask").submit(function() {
                var task_type = $('input:radio[name=task_type]');

                // 태스크 타입 체크
                if (! task_type.is(':checked')) {
                    return false;
                }

                // 마감기한 체크
                if (! checkDateFormat($("#deadline_date").val())) {
                    return false;
                }

                if (task_type.val() === "price") {
                    if (! checkDateFormat($("#deposit_date").val())) {
                        return false;
                    }
                }

                return true;
            });
        });

        function checkDateFormat(date)
        {
            var dayRegExp = /^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[0-1])$/;

            return dayRegExp.test(date);
        }

        //        $.extend({
        //            checkDateFormat : function(date) {
        //                var df = /[0-9]{4}-[0-9]{2}-[0-9]{2}/;
        //                var checkdate = true;
        //                if (date.match(df) != null) {
        //                    checkdate = false;
        //                }
        //
        //                return checkdate;
        //            }
        //        });

    </script>
@stop