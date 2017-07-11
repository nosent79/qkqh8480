/**
 * Created by 최진욱 on 2017-07-11.
 */
$(function() {
    $("._btn_list").click(function () {
        var url = $(this).data('href');
        location.href = url;
    });

    $("._btn_register").click(function () {
        var url = $(this).data('href');
        location.href = url;
    });

    $("._btn_modify").click(function () {
        var url = $(this).data('href');
        location.href = url;
    });

    $("._btn_delete").click(function () {
        var url = $(this).data('href');
        location.href = url;
    });
});