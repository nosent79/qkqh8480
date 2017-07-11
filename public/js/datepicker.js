/**
 * Created by 최진욱 on 2017-07-11.
 */
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
});