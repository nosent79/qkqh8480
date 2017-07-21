function parseToDateFormat(date)
{
    var parmas_length = arguments.length; // 매개변수의 개수를 가져옵니다.

    return date.getFullYear() + '-' + pad(date.getMonth()+1) + '-' + pad(date.getDate());
}

function pad(num)
{
    num = num + '';

    return num.length < 2 ? '0' + num : num;
}
