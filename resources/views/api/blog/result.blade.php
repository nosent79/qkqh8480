
@php
    //header("Content-Type: text/plain");

function existData($arr)
{
    if (isset($arr) === true && ! empty($arr)) {
        return true;
    }

    return false;
}

@endphp



@php
    $html = "#title# 축제 및 행사가 #eventstartdate#부터 #eventenddate#까지 #eventplace#에서 열린다.";
    $html .= "<br />";
    $html .= "주최사는 #sponsor1#이며, 연락 가능한 번호는 #sponsor1tel#이다.";

    if (isset($result['sponsor2']) === true) {
        $html .= " 주관사는 #sponsor2#이 맡았다. ";
    }

    $html .= "<br />";

    if (isset($result['homepage']) === true) {
        $html .= "공식 홈페이지는 #homepage# 이다.";
    }

    $html .= "<br /><br />";

    $html .= "#title#의 행사 개요는 아래와 같다. <br /> #overview#  <br />";

    if (existData($result['infotext']) === true) {
        $html .= "#infotext# 등 다양한 프로그램이 준비되어있다. ";
    }

    $html.="<br /><br />";

    if (existData($result['placeinfo'] === true)) {
        $html .= "행사장 위치는 #placeinfo#이다.";
        $html.="<br />";
    }

    if (existData($result['playtime']) === true) {
        if (strlen($result['playtime']) > 20) {
            $html .= "공연 시간은 정보는 아래와 같다. <br /> #playtime# 이며,";
        } else {
            $html .= "공연 시간은 #playtime# 까지 이며, ";
        }
    }

    if (existData($result['spendtimefestival']) === true) {
        $html .= " 관람소요시간은 #spendtimefestival#이다.";
    }

    if (existData($result['agelimit']) === true) {
        $html .= "<br />#agelimit#이 이용 가능하며, ";
    }

    if (existData($result['usetimefestival']) === true) {
        if (strlen($result['usetimefestival']) > 20) {
            $html .= "요금 정보는 아래와 같다. <br /> #usetimefestival#.";
        } else {
            $html .= "요금은 #usetimefestival#이다.";
        }
    }

    if (existData($result['addr1']) === true) {
        $html .= "<br />주소는 #addr1#이다.";
    }

    if (existData($result['subevent']) === true) {
        $html .= "<br />#subevent#이다.";
    }

    if (existData($result['discountinfofestival']) === true) {
        $html .= "<br />#discountinfofestival#이다.";
    }

    if (existData($result['program']) === true) {
        $html .= "<br /><br />준비된 프로그램은 다음과 같다.";
        $html .= "<br />#program#";
    }



@endphp

@php
    $html = str_replace("#title#", getArrayValue('title', $result), $html);
    $html = str_replace("#eventstartdate#", fnParseDateToKor(getArrayValue('eventstartdate', $result)), $html);
    $html = str_replace("#eventenddate#", fnParseDateToKor(getArrayValue('eventenddate', $result)), $html);
    $html = str_replace("#eventplace#", getArrayValue('eventplace', $result), $html);
    $html = str_replace("#sponsor1#", getArrayValue('sponsor1', $result), $html);
    $html = str_replace("#sponsor1tel#", getArrayValue('sponsor1tel', $result), $html);
    $html = str_replace("#sponsor2#", getArrayValue('sponsor2', $result), $html);
    $html = str_replace("#homepage#", getArrayValue('homepage', $result), $html);
    $html = str_replace("#overview#", getArrayValue('overview', $result), $html);
    $html = str_replace("#infotext#", getArrayValue('infotext', $result), $html);
    $html = str_replace("#placeinfo#", getArrayValue('placeinfo', $result), $html);
    $html = str_replace("#playtime#", getArrayValue('playtime', $result), $html);
    $html = str_replace("#spendtimefestival#", getArrayValue('spendtimefestival', $result), $html);
    $html = str_replace("#agelimit#", getArrayValue('agelimit', $result), $html);
    $html = str_replace("#usetimefestival#", getArrayValue('usetimefestival', $result), $html);
    $html = str_replace("#addr1#", getArrayValue('addr1', $result), $html);
    $html = str_replace("#subevent#", getArrayValue('subevent', $result), $html);
    $html = str_replace("#program#", getArrayValue('program', $result), $html);
    $html = str_replace("#discountinfofestival#", getArrayValue('discountinfofestival', $result), $html);
@endphp
{!! $html . "<br />" !!}

@if (count($images) > 0)
    @foreach($images as $k => $v)

        <img src="{{ $v['originimgurl'] }}" /> <br />
    @endforeach
@endif