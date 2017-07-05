/**
 * Created by 최진욱 on 2017-07-05.
 */
/**
 * Created by user on 2016-05-25.
 */

try {
    sriValidate.jqDatepicker(".datepicker");
    $('.elastic_textarea').elastic();
} catch(e){}

$('.onlyNum')
    .on('keyup', function () {
        sriValidate.onlyNum(this);
    })
    .on('focusout', function(){
        //sriValidate.onlyNum(this);
    });

$('.notNum')
    .on('keyup', function () {
        sriValidate.notNum(this);
    })
    .on('focusout', function(){
        sriValidate.notNum(this);
    });

$('.engNum')
    .on('keyup', function () {
        sriValidate.engNum(this);
    })
    .on('focusout', function(){
        sriValidate.engNum(this);
    });

$('.dotNum')
    .on('keyup', function () {
        sriValidate.dotNum(this);
    })
    .on('focusout', function(){
        sriValidate.dotNum(this);
    });

$('.hyphenDotNum')
    .on('keyup', function () {
        sriValidate.hyphenDotNum(this);
    })
    .on('focusout', function(){
        sriValidate.hyphenDotNum(this);
    });

$('.onlyKor')
    .on('keyup', function () {
        sriValidate.onlyKor(this);
    })
    .on('focusout', function () {
        //sriValidate.onlyKor(this);
    });

$('.onlyKorEngSpace')
    .on('keyup', function () {
        sriValidate.onlyKorEngSpace(this);
    });


$('.notKor')
    .on('keyup', function (event) {
        sriValidate.notKor(this);
    });

$('.onlyEng')
    .on('keyup', function () {
        sriValidate.onlyEng(this);
    })
    .on('focusout', function(){
        sriValidate.onlyEng(this);
    });

$('.onlyEngSpace')
    .on('keyup', function () {
        sriValidate.onlyEngSpace(this);
    })
    .on('focusout', function(){
        sriValidate.onlyEngSpace(this);
    });

$('.onlyEngSpaceDashAnd')
    .on('keyup', function () {
        sriValidate.onlyEngSpaceDashAnd(this);
    })
    .on('focusout', function(){
        sriValidate.onlyEngSpaceDashAnd(this);
    });

$('.onlyEngSpaceDashAndNum')
    .on('keyup', function () {
        sriValidate.onlyEngSpaceDashAndNum(this);
    })
    .on('focusout', function(){
        sriValidate.onlyEngSpaceDashAndNum(this);
    });
