/**
 * Created by 최진욱 on 2017-07-06.
 */
// $(document).ready(function () {
$(function() {
    $("._btn_list").click(function () {
        var url = $("._btn_list").data('href');
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

    $("._task_type").click(function () {
        var type = $(this).children('input').val();
        setTaskType(type);
    });

    $("._orderby").click(function () {
        var url = $(this).data('href');
        location.href = url;
    });
});

function _init(type)
{
    setTaskType(type);
    setAddClassForLabel('task_type');
}

function setAddClassForLabel(el)
{
    $("input:radio[name='"+el+"']:checked").parent().addClass('active');
}

function setTaskType(flag)
{
    var type = $('input:radio[name=task_type]:input[value=' + flag + ']').attr("checked", true).val();

    if (type === "product") {
        $("#task_price").hide();
    } else {
        $("#task_price").show();
    }

    $("#task_type").val(type);
}