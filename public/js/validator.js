/**
 * Created by 최진욱 on 2017-07-05.
 */

var validate = {
    //	Null 체크
    'chkNull': function (obj) {
        if ($(obj).val().split(" ").join("") == "") {
            return true;
        }

        return false;
    },

    // 텍스트상자 입력 체크
    'chkTextInput': function (obj, alertMSG) {
        if (this.chkNull(obj)) {
            alert(alertMSG);
            obj.focus();
            return true;
        }
        return false;
    },

    // 두 값을 비교
    'compareTextValue': function ( obj1, obj2, alertMSG) {
        if (obj1.val() != obj2.val()) {
            alert(alertMSG);
            obj2.val('')
            obj2.focus();
            return true;
        }
        return false;
    },

    // 체크상자 확인
    'chkCheckBox' : function (obj, alertMSG) {
        if(!obj.is(":checked")) {
            alert(alertMSG);
            obj.focus();
            return true;
        }
    },


    // 이메일 형식체크
    'chkeMailExp': function (obj) {
        var objvalue = "";
        var regExp = /^[\w\-\.]+@(?:(?:[\w\-]{2,}\.)+[a-zA-Z]{2,})$/;
        if(typeof obj === 'object') {
            objvalue = obj.val();

            if (objvalue == "" || !regExp.test(objvalue)) {
                alert("이메일 형식이 맞지않습니다");
                obj.focus();
                return false;
            }
        } else {
            objvalue = obj;

            if (objvalue == "" || !regExp.test(objvalue)) {
                alert("이메일 형식이 맞지않습니다");
                return false;
            }
        }
        return true;
    },

    // 영문,숫자,특수문자 방지
    'chkOnlyKor': function (obj) {
        var rtn;
        for (var j = 0; j < obj.length; j++) {
            var vAsc = obj.charCodeAt(j);
            if (((vAsc > 96) && (vAsc < 124)) || ((vAsc > 64) && (vAsc < 91)) || ((vAsc > 31) && (vAsc < 48) || (vAsc >= 48) && (vAsc <= 57))) {
                rtn = true;
                alert("【 입력오류 】: 영문,숫자,특수문자는 입력할 수 없습니다. 한글만 입력해 주세요.    ");
                break;
            }
            else {
                rtn = false;
            }
        }
        return rtn;
    },

    // 숫자만
    'onlyNum': function (obj) {
        var re = /[^0-9]+/g;
        var that = obj;
        if("imeMode" in that.style) that.style.imeMode = "disabled";	//다국어 입력이 가능해서 막도록

        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.value = arguments[arguments.length - 1].replace(curVal, "");
            alert('숫자만 입력바랍니다.');
        });
    },

    // !숫자
    'notNum': function (obj) {
        var re = /[0-9]+/g;
        var that = obj;
        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.value = arguments[arguments.length - 1].replace(curVal, "");
        });
    },

    // 숫자 & .
    'dotNum': function (obj) {
        var re = /[^\d\.]/g;
        var that = obj;
        if("imeMode" in that.style) that.style.imeMode = "disabled";	//다국어 입력이 가능해서 막도록

        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.value = arguments[arguments.length - 1].replace(curVal, "");
            alert('숫자와 점(.)만 입력바랍니다.');
        });
    },

    //숫자 & '-' & '.'
    'hyphenDotNum': function (obj) {
        var re = /[^\d\.\-]/g;
        var that = obj;
        if("imeMode" in that.style) that.style.imeMode = "disabled";	//다국어 입력이 가능해서 막도록

        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.value = arguments[arguments.length - 1].replace(curVal, "");
            alert('숫자와 하이픈(-) 및 점(.)만 입력바랍니다.');
        });
    },

    //한글만
    'onlyKor': function (obj) {
        var re = /[^ㄱ-ㅎㅏ-ㅣ가-힣]+/g;
        var that = obj;
        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.value = arguments[arguments.length - 1].replace(curVal, "");
        });
    },

    //한글, 영문, 스페이스만
    'onlyKorEngSpace': function (obj) {
        var re = /^[^ㄱ-ㅎ|가-힣|a-z|A-Z\s]+$/g;
        var that = obj;
        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.value = arguments[arguments.length - 1].replace(curVal, "");
        });

    },

    //!한글
    'notKor': function (obj) {
        var re = /[ㄱ-ㅎㅏ-ㅣ가-힣]+/g;
        var that = obj;
        that.value.replace(re, function (curVal, curNum, totalVal) {
            that.focus();
            that.value = arguments[arguments.length - 1].replace(curVal, "");
        });
    },

    //영어만
    'onlyEng': function (obj) {
        var re = /[^a-z]/gi;
        obj.value = obj.value.replace(re, '');
    },

    'onlyEngSpace': function (obj) {
        var re = /[^a-z\s]|/gi;
        obj.value = obj.value.replace(re, '');
    },

    'onlyEngSpaceDashAnd': function (obj) {
        var re = /[^a-z\s\-&]|/gi;
        obj.value = obj.value.replace(re, '');
    },

    'onlyEngSpaceDashAndNum': function (obj) {
        var re = /[^a-z\s\-&\d]|/gi;
        obj.value = obj.value.replace(re, '');
    },

    // 이메일 형식체크
    'emailExpCheck': function (obj) {
        var objvalue = obj;
        //var regExp = /^(19|20)\d{2}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[0-1])$/;
        var regExp = /^[\w\-\.]+@(?:(?:[\w\-]{2,}\.)+[a-zA-Z]{2,})$/;
        if (objvalue == "") {
            return false;
        } else {
            if (!regExp.test(objvalue)) {
                return false;
            }
        }
        return true;
    },
    "jqDatepicker": function (obj) {
        $(obj).css({ "width": "70px" }).attr('readonly', 'readonly').datepicker({
            showOn: "both", // 버튼과 텍스트 필드 모두 캘린더를 보여준다.
            buttonImage: "https://www.saraminimage.co.kr/dym_images/dym2_5/common/applicant/calendar.gif", // 버튼 이미지
            buttonImageOnly: true, // 버튼에 있는 이미지만 표시한다.
            changeMonth: true, // 월을 바꿀수 있는 셀렉트 박스를 표시한다.
            changeYear: true, // 년을 바꿀 수 있는 셀렉트 박스를 표시한다.
            minDate: '-100y', // 현재날짜로부터 100년이전까지 년을 표시한다.
            nextText: '다음 달', // next 아이콘의 툴팁.
            prevText: '이전 달', // prev 아이콘의 툴팁.
            numberOfMonths: [1, 1], // 한번에 얼마나 많은 월을 표시할것인가. [2,3] 일 경우, 2(행) x 3(열) = 6개의 월을 표시한다.
            stepMonths: 3, // next, prev 버튼을 클릭했을때 얼마나 많은 월을 이동하여 표시하는가.
            yearRange: 'c-100:c+100', // 년도 선택 셀렉트박스를 현재 년도에서 이전, 이후로 얼마의 범위를 표시할것인가.
            showButtonPanel: true, // 캘린더 하단에 버튼 패널을 표시한다.
            currentText: '오늘 날짜', // 오늘 날짜로 이동하는 버튼 패널
//            closeText: '닫기',  // 닫기 버튼 패널
            dateFormat: "yy-mm-dd", // 텍스트 필드에 입력되는 날짜 형식.
            showAnim: "slide", //애니메이션을 적용한다.
            showMonthAfterYear: true, // 월, 년순의 셀렉트 박스를 년,월 순으로 바꿔준다.
            dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'], // 요일의 한글 형식.
            monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'], // 월의 한글 형식.
            closeText: 'Clear',
            onClose: function (dateText, inst) {
                if ($(window.event.srcElement).hasClass('ui-datepicker-close'))
                {
                    document.getElementById(this.id).value = '';
                }
            }
        });
    }
}