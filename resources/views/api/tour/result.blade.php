
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
{!! $html !!}


@if (count($images) > 0)
        @foreach($images as $k => $v)
            <img src="{{ $v['originimgurl'] }}" /> <br />
        @endforeach
@endif
{{ dd("") }}
{{--str_replace("\$사진필수\$", "사진,", $privacy_cc2);--}}
{{--부산항축제 2018 축제가 2018년 05월 25일부터 2018년 05월 27일까지 부산항국제여객터미널 및 국립해양박물관 일원에서 열린다. 부산광역시, 부산지방해양수산청, 부산항만공사이 주최하며, 연락처는 051-501-6051이다.--}}
{{--주관사는 부산문화관광축제조직위원회이 맡았다. 공식 홈페이지는 http://www.bfo.or.kr 이다. 부산항축제 2018의 행사 소개는 다음과 같다. 5월 가정의 달, 온 가족이 함께 즐길 거리를 찾고 있으신가요? --}}
{{--매년 5월 부산항축제가 열린다. 부산항축제는 부산시민들조차 가까이 있지만 평소에는 접하기 힘든 부산항과 부두, 선박 등을 직접 보고 체험할 수 있는 다양한 프로그램이 마련되어 있는 체험형 축제로, 해양·항만 관련 기업·기관·단체·대학이 축제에 참여하고 있다. 부산항 관련 산업과 문화, 교육이 결합된 다양한 프로그램을 지속적으로 개발해나가며 세계수준의 항만축제로 성장해 나가고 있다.--}}


<div class="tour">
        <div id="tourTip">
            <span>한국관광공사에서 제공하는 공공데이터를 활용하여 <?=$result['title']?>를 소개합니다.</span>
    </div>
    <div id="tourWrap">
        <div id="tourPic">
            @php
                if (getArrayValue("firstimage", $result) === '') {
                    $img_path = asset('images/not_available.png');
                } else {
                    $img_path = getArrayValue("firstimage", $result);
                }
            @endphp
            <img width="300" src={{ $img_path }} alt="firstimage">


        </div>
        <div id="tourUlWrap">
            <ul id="tourUl">
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAcUlEQVQ4T7VSWw7AIAiD+x96BrMuPA3OyI/yaEMBJmsPEbGLaTfkpViCYvjrmAZnefYEAIDUE/i8IVh0XqY+gpXuCj3noXXp9rze0r9C0J1FkIAdb71tre+9hPpsBtclmG39kVASdFtPCXbBqJ+XeGQDJsNAEVp/4O4AAAAASUVORK5CYII=" alt="calendar"></span><span><?=getParseDate(getArrayValue('eventstartdate', $result)) . " ~ " . getParseDate(getArrayValue('eventenddate', $result))?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACh0lEQVQ4T4WTz0tUURTHv+c+m3H+gCDn3ft0YUFohFibcBFUSEUbIwuDFhEF0U+IihZF9JNoY0aK/RCkEqWiCBfmJsmFkYtaFAQSzbvvPgfbhITNz3vijTORZXV3h/O9H875nnMI/35UTvPfZBXBgryUcpUQfJUZTQBHmrfW0mljzLvfQX8APM/dwIweIXAslTIjAFgptRGwXYA9pPX0i18hCwANDQ2x2dmv75lpe3X13OdsNnGEmZ2qqlintZkks/MsHk80Tk1NZSuQBQCl1FqAL2odtErp9gvBvcUiFYTAca3NTind58y4ZIyZWBTgee4OgDf5frhfKXdIa9MeCZVKPtE6bFPKvQXwK63DgUUBZfP6fd80eZ48xcxLmbkA4HsQhOeVSr5hFieE4CaiqsFUKjX9s4Vy/3sBdDHTriAIHiulGq21TuS+5yW3MdNTACEzvhHxNa3DvhJASrmciCN3x5hpiIi7i0VuCcNQR/na2toaawuviWgglytcj8WczQCv8f3wSAmgVPIgQFJrc2Y+lncBXqG1WR+NUUp3VAga9/3g3HxeNQK2R2vTUgJ4XvI2QCO+bx5VAEQ2zkyfAGSJEO3GuNbmbNk8R0o3DAJTU65AThKJdt/3ow9Qyu3LZHKHE4nYZBRbS+sAvhIE5kDFfaXcCWuxh5qbm5fMzKS11mZZXV1ddbGY6yCik9bSBcexH/J5zIVh+FEpeUfrYN+8JzUrrRX3mekyua67Wgh+QCSGmXk3gFEiDDNjC4BWgMaI+KG1aHccDFqLo8xQRHyTWdwjKWUbEd8A0J3PF3vT6fSXSpn19fXxTCazVQjuKANfAqJTax1NrHShlT0QUav/Oe1FNT8AxhI8nTGoDh0AAAAASUVORK5CYII=" alt="address"></span><span><?=getArrayValue('addr1', $result)?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACKUlEQVQ4T5VTv2tUQRCeec94uQNB5Yr49sddwCJoSCfRYKWNIDamE5SIIigIFoqSaGEnSFARI1pYRf8A5Yq0EUQjggQs1CNcdnYfXiNaGPC8fSNrfOEuuSBuM7xvvv1mduZ7CJucajUZyjIcCWnv4b1z7lMvKq4HhRAyiuAJMyhEWGAGRIRRAF5ijs5aa13nnS4BrQf2MMc1Zpyy1j7rJGotTjHDTe/5SJqmH/Ncp8AWpcQrgOgGEc0FQpIkOsQ0TU2IWifHmHGSyB0MLwvYmoCUchyRTxC58YArJe8D8LfVSridyF4EANZa1Jj5EVH6vEtAKTGNCGSMu1upiKPe4w5r7exqZXESEb4uL7ua1vIqAOw0xobY2UFyDyBasNY+1Vqe854XnXOvA0kIsT+OccQY+1gpMQEAw0Tu8nqBM4jREJG9EjYRx3xrZaV1PpBKpa0PvcdrzjmrlLjDjO/y7tZmkCSJimOcb7Xaw81m84fWei+zv/CnCsYzxpgP5XJ5W7FYWIzjvgONRuNLVwfhQyl5m5n7rHWXeplGKfEAAL4Tuclea4Rqtdrv/a83iHzdmPRFp4iU8jgiTxUKxbF6vf6zp0AAg4W9xzlmHMtdNzi4q9JuRy+Z8bC19vOmTswTSiWnAWCCKD0URqC1mM8ynMkH90+Bv66bBYjqWZb1I+IAkQvr23A2/Ew5I0y8VCq8ZYas1WrvC5v5L4FAllLujqIoM8Ys9bocsN8joPMR8dX/AgAAAABJRU5ErkJggg==" alt="location"></span><span><?=getArrayValue('eventplace', $result)?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAB+0lEQVQ4T42SO4gTURSG/3MnM3GNksLAyDw22cjCCoJFEGxELRRB8LVqIbKt2GihWLiwVgrCNtoKFhY+QFhYsFgU7RTBRqwTsnNnriaFIhizs/M4MpsERWUnp7lw7n++8+AnDKNSqWwvlYr7VleDNwB4lM97KRPU6/VyFIUrw0KhafrJdrv9Ja84+yfLsrZqGr0G+LmUanFy0r7ETFeYccD3/a95EHIcZ1aI9LTnqYsjsevad5i55Pvqai6gWjWn0rTwQspgD4A0K3Ac64YQdNDzguO5gEzgus4SkD6TUj11XddiTt8aRnFvq9X6PhagVrNmkoRWhCjs7/V6PyYmis319Xiq0+n0xgJkosHxMCtlcMx17XlmTPt+MDc2YLC7/QhA3/eDy45jvxSClj3Pv7cZZMMHo2g0Gnq3+3kZoA9RlNzXdW0JwEdN068JIYpxHD4GuAkUbnme923DB3/TTdMsGUYhM9V7TdPnkyS6DeAcgJCZHxBRGaBThhEdbjY73X8AGbBWq21JkvghwNvW1tYvlMvlKAzDHVJKNbpXmmLONHce+i9gNJXjWAtEdCZJ+IRSyvtzWte13xHxwqaAYbfzzLgL8E0p1ZOBb6zrAJ3t98MjuYDBStZMHNMiEaoAfQJ4l64Xj2ZGGwvweyVnmijdnSR4pZT6meV/Ad1jxpPpSQUHAAAAAElFTkSuQmCC" alt="contact"></span><span><?=getArrayValue('tel', $result)?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABS0lEQVQ4T8WTP0sDQRDF3+zeXVA4LBQEiwghBPQEA9vbi4paCBZil8pa/RA2gmU+gRwBQTutrIKwGsE/kEptRBQxBARztztyFsFDhSQEnGZgmPkx84ZHgVJZNtghYBxdBAP3JLFJk0W1T8BxJHHQxTw8S4uWeY6CoqpGEvOuwZIwrYpxvLX3Ib882GhuBPncbhiG5jdwQakR1+CkDfCBhtY6Ukq53/NfW6UAABwAcacnCIPSh4fH9gaG5bp1zGungLrWLz9OSIqdApK+/gMG4jhjhZe3sDNk+YqF8C3MnWQpLCEnmJ+YoMiiGmektsZQ6gtjvv/23GgegTEKoMbMpyTEMpgJ4AqDZokwAcv168vzlYJSwylAokEwrbYBnIGQReQdwmmVvnSJvTLc1ioYtywwdXOh9/qvwf99oVczJd4BeIF6tTMBDzHM1icIkcpJqvoPyQAAAABJRU5ErkJggg==" alt="homepage"></span><span><?=getArrayValue('homepage', $result)?></span></li>
            </ul>
        </div>
    </div>

    <div id="tourSummary" class="tourSection">
        <div class="title">개요</div>
        <div class="content"><?=getArrayValue('overview', $result)?></div>
    </div>

    <div id="tourDetail" class="tourSection">
        <div class="title">행사정보</div>
        <div class="content">
            <ul>
                <li><em>행사 내용</em><span><?=getArrayValue('infotext', $result)?></span></li>
                <li><em>주최자 정보</em><span><?=getArrayValue('sponsor1', $result)?></span></li>
                <li><em>주최자 연락처</em><span><?=getArrayValue('sponsor1tel', $result)?></span></li>
                <li><em>주최자 정보</em><span><?=getArrayValue('sponsor2', $result)?></span></li>
                <li><em>주관사 연락처</em><span><?=getArrayValue('sponsor2tel', $result)?></span></li>
                <li><em>행사장 위치정보</em><span><?=getArrayValue('placeinfo', $result)?></span></li>
                <li><em>프로그램</em><span><?=getArrayValue('program', $result)?></span></li>
                <li><em>부대행사</em><span><?=getArrayValue('subevent', $result)?></span></li>
                <li><em>행사 홈페이지</em><span><?=getArrayValue('eventhomepage', $result)?></span></li>
            </ul>
        </div>
    </div>

    <div id="tourUse" class="tourSection">
        <div class="title">이용안내</div>
        <div class="content">
            <ul>
                <li><em>공연시간</em><span><?=getArrayValue('playtime', $result)?></span></li>
                <li><em>관람소요시간</em><span><?=getArrayValue('spendtimefestival', $result)?></span> </li>
                <li><em>관람가능연령</em><span><?=getArrayValue('agelimit', $result)?></span></li>
                <li><em>이용요금</em><span><?=getArrayValue('usetimefestival', $result)?></span></li>
                <li><em>예매처</em><span><?=getArrayValue('bookingplace', $result)?></span></li>
                <li><em>할인정보</em><span><?=getArrayValue('discountinfofestival', $result)?></span></li>
            </ul>
        </div>
    </div>

    <div id="tourImages" class="tourSection">
        <div class="title">관련 사진</div>
        <div class="content">
            @if (count($images) > 0)
            <ul>
                @foreach($images as $k => $v)
                    {{--<label class="_ts"><input type="radio" name="task_state" value="{{ $k }}" {{ getSelectedText($params->get('task_state'), $k, 'checked') }} disabled="true">{{ $v }}</label>--}}
                    <li><img src="{{ $v['originimgurl'] }}" alt="{{$k}}" /></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>

    <div class="tourSection">
        <div id="tourMore">
            <a href='{{ "http://touristinkorea.com/" . config("constants.contentTypeKey.{$result['contenttypeid']}") . "/" . $result['contentid'] }}' target="_blank">
                <img src="http://img1.daumcdn.net/thumb/R1920x0/?fname=http%3A%2F%2Fcfile22.uf.tistory.com%2Fimage%2F99921A455AF63201062914"  />
            </a>
        </div>
    </div>

</div>
