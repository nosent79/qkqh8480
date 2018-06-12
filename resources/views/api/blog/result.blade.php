
@php
    //header("Content-Type: text/plain");

function existData($arr, $key)
{
    if (isset($arr[$key]) === true && ! empty($arr[$key])) {
        return true;
    }

    return false;
}
@endphp

@php
    $html = "";

    if (getArrayValue("firstimage", $result) !== '') {
        $img_path = getArrayValue("firstimage", $result);
        $html .= "<img src={$img_path} alt='main image'>";
        $html .= "<br /><br /><br />";
    }

    $html .= "#title# 축제 및 행사가 ";
    $html .= "<br />";
    $html .= "#eventstartdate#부터 #eventenddate#까지 ";

    if (existData($result, 'eventplace') === true) {
        $html .= "#eventplace#에서 열립니다.";
    } else {
        $html .= "열립니다.";
    }

    if (existData($result, 'addr1') === true) {
        $html .= "<br />주소는 #addr1#입니다.";
    }

    $html .= "<br /><br />";
    $html .= "주최사는 #sponsor1#이며, 연락 가능한 번호는 #sponsor1tel#입니다.";
    $html .= "<br />";

    if (existData($result, 'sponsor2') === true) {
        $html .= " 주관사는 #sponsor2#이 맡았습니다. ";
        $html .= "<br />";
    }

    if (existData($result, 'homepage') === true) {
        $html .= "공식 홈페이지는 #homepage# 입니다.";
        $html .= "<br /><br />";
    }

    $html .= "#title#의 행사 개요는 아래와 같습니다.";
    $html .= "<br />";
    $html .= "#overview#";
    $html .= "<br /><br />";

    if (existData($result, 'infotext') === true) {
        if ($result['infotext'] != $result['overview'] && strlen($result['infotext']) > 15) {
            $html .= "#infotext# 등 다양한 프로그램이 준비되어있습니다. ";
            $html.="<br /><br />";
        }
    }

    if (existData($result, 'placeinfo') === true) {
        $html .= "행사장 위치는 #placeinfo#입니다.";
        $html.="<br />";
    }

    if (existData($result, 'playtime') === true) {
        if (strlen($result['playtime']) > 20) {
            $html .= "공연 시간은 정보는 아래와 같습니다. <br /> #playtime# 이며,";
        } else {
            $html .= "공연 시간은 #playtime# 까지 이며, ";
        }
    }

    if (existData($result, 'spendtimefestival') === true) {
        $html .= " 관람소요시간은 #spendtimefestival#입니다.";
    }

    if (existData($result, 'agelimit') === true) {
        $html .= "<br />#agelimit#이 이용 가능하며, ";
    }

    if (existData($result, 'usetimefestival') === true) {
        if (strlen($result['usetimefestival']) > 20) {
            $html .= "요금 정보는 아래와 같습니다. <br /> #usetimefestival#.";
        } else {
            $html .= "요금은 #usetimefestival#입니다.";
        }
    }


    if (existData($result, 'subevent') === true) {
        $html .= "<br />#subevent#입니다.";
    }

    if (existData($result, 'discountinfofestival') === true) {
        if (strlen($result['discountinfofestival']) > 20) {
            $html .= "<br /><br />";
            $html .= "할인정보는 아래와 같습니다.";
            $html .= "<br />";
            $html .= "#discountinfofestival#";
        } else {
            $html .= "#discountinfofestival#";
        }
    }

    if (existData($result, 'program') === true) {
        $html .= "<br /><br />준비된 프로그램은 다음과 같습니다.";
        $html .= "<br />#program#";
    }

@endphp

@php
    $html = str_replace("#title#", getArrayValue('title', $result), $html);
    $html = str_replace("#eventstartdate#", fnParseDateToKor(getArrayValue('eventstartdate', $result)), $html);
    $html = str_replace("#eventenddate#", fnParseDateToKor(getArrayValue('eventenddate', $result)), $html);
    $html = str_replace("#eventplace#", getArrayValue('eventplace', $result), $html);
    $html = str_replace("#addr1#", getArrayValue('addr1', $result), $html);
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
    $html = str_replace("#discountinfofestival#", getArrayValue('discountinfofestival', $result), $html);
    $html = str_replace("#program#", getArrayValue('program', $result), $html);
@endphp
{!! $html . "<br />" !!}


{{--{{ dd($result) }}--}}