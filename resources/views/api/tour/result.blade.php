
@php
    header("Content-Type: text/plain");
@endphp

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
            <img width="300" src={{ $img_path }}>


        </div>
        <div id="tourUlWrap">
            <ul id="tourUl">
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAcUlEQVQ4T7VSWw7AIAiD+x96BrMuPA3OyI/yaEMBJmsPEbGLaTfkpViCYvjrmAZnefYEAIDUE/i8IVh0XqY+gpXuCj3noXXp9rze0r9C0J1FkIAdb71tre+9hPpsBtclmG39kVASdFtPCXbBqJ+XeGQDJsNAEVp/4O4AAAAASUVORK5CYII="></span><span><?=getParseDate(getArrayValue('eventstartdate', $result)) . " ~ " . getParseDate(getArrayValue('eventenddate', $result))?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACh0lEQVQ4T4WTz0tUURTHv+c+m3H+gCDn3ft0YUFohFibcBFUSEUbIwuDFhEF0U+IihZF9JNoY0aK/RCkEqWiCBfmJsmFkYtaFAQSzbvvPgfbhITNz3vijTORZXV3h/O9H875nnMI/35UTvPfZBXBgryUcpUQfJUZTQBHmrfW0mljzLvfQX8APM/dwIweIXAslTIjAFgptRGwXYA9pPX0i18hCwANDQ2x2dmv75lpe3X13OdsNnGEmZ2qqlintZkks/MsHk80Tk1NZSuQBQCl1FqAL2odtErp9gvBvcUiFYTAca3NTind58y4ZIyZWBTgee4OgDf5frhfKXdIa9MeCZVKPtE6bFPKvQXwK63DgUUBZfP6fd80eZ48xcxLmbkA4HsQhOeVSr5hFieE4CaiqsFUKjX9s4Vy/3sBdDHTriAIHiulGq21TuS+5yW3MdNTACEzvhHxNa3DvhJASrmciCN3x5hpiIi7i0VuCcNQR/na2toaawuviWgglytcj8WczQCv8f3wSAmgVPIgQFJrc2Y+lncBXqG1WR+NUUp3VAga9/3g3HxeNQK2R2vTUgJ4XvI2QCO+bx5VAEQ2zkyfAGSJEO3GuNbmbNk8R0o3DAJTU65AThKJdt/3ow9Qyu3LZHKHE4nYZBRbS+sAvhIE5kDFfaXcCWuxh5qbm5fMzKS11mZZXV1ddbGY6yCik9bSBcexH/J5zIVh+FEpeUfrYN+8JzUrrRX3mekyua67Wgh+QCSGmXk3gFEiDDNjC4BWgMaI+KG1aHccDFqLo8xQRHyTWdwjKWUbEd8A0J3PF3vT6fSXSpn19fXxTCazVQjuKANfAqJTax1NrHShlT0QUav/Oe1FNT8AxhI8nTGoDh0AAAAASUVORK5CYII="></span><span><?=getArrayValue('addr1', $result)?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACKUlEQVQ4T5VTv2tUQRCeec94uQNB5Yr49sddwCJoSCfRYKWNIDamE5SIIigIFoqSaGEnSFARI1pYRf8A5Yq0EUQjggQs1CNcdnYfXiNaGPC8fSNrfOEuuSBuM7xvvv1mduZ7CJucajUZyjIcCWnv4b1z7lMvKq4HhRAyiuAJMyhEWGAGRIRRAF5ijs5aa13nnS4BrQf2MMc1Zpyy1j7rJGotTjHDTe/5SJqmH/Ncp8AWpcQrgOgGEc0FQpIkOsQ0TU2IWifHmHGSyB0MLwvYmoCUchyRTxC58YArJe8D8LfVSridyF4EANZa1Jj5EVH6vEtAKTGNCGSMu1upiKPe4w5r7exqZXESEb4uL7ua1vIqAOw0xobY2UFyDyBasNY+1Vqe854XnXOvA0kIsT+OccQY+1gpMQEAw0Tu8nqBM4jREJG9EjYRx3xrZaV1PpBKpa0PvcdrzjmrlLjDjO/y7tZmkCSJimOcb7Xaw81m84fWei+zv/CnCsYzxpgP5XJ5W7FYWIzjvgONRuNLVwfhQyl5m5n7rHWXeplGKfEAAL4Tuclea4Rqtdrv/a83iHzdmPRFp4iU8jgiTxUKxbF6vf6zp0AAg4W9xzlmHMtdNzi4q9JuRy+Z8bC19vOmTswTSiWnAWCCKD0URqC1mM8ynMkH90+Bv66bBYjqWZb1I+IAkQvr23A2/Ew5I0y8VCq8ZYas1WrvC5v5L4FAllLujqIoM8Ys9bocsN8joPMR8dX/AgAAAABJRU5ErkJggg=="></span><span><?=getArrayValue('eventplace', $result)?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAB+0lEQVQ4T42SO4gTURSG/3MnM3GNksLAyDw22cjCCoJFEGxELRRB8LVqIbKt2GihWLiwVgrCNtoKFhY+QFhYsFgU7RTBRqwTsnNnriaFIhizs/M4MpsERWUnp7lw7n++8+AnDKNSqWwvlYr7VleDNwB4lM97KRPU6/VyFIUrw0KhafrJdrv9Ja84+yfLsrZqGr0G+LmUanFy0r7ETFeYccD3/a95EHIcZ1aI9LTnqYsjsevad5i55Pvqai6gWjWn0rTwQspgD4A0K3Ac64YQdNDzguO5gEzgus4SkD6TUj11XddiTt8aRnFvq9X6PhagVrNmkoRWhCjs7/V6PyYmis319Xiq0+n0xgJkosHxMCtlcMx17XlmTPt+MDc2YLC7/QhA3/eDy45jvxSClj3Pv7cZZMMHo2g0Gnq3+3kZoA9RlNzXdW0JwEdN068JIYpxHD4GuAkUbnme923DB3/TTdMsGUYhM9V7TdPnkyS6DeAcgJCZHxBRGaBThhEdbjY73X8AGbBWq21JkvghwNvW1tYvlMvlKAzDHVJKNbpXmmLONHce+i9gNJXjWAtEdCZJ+IRSyvtzWte13xHxwqaAYbfzzLgL8E0p1ZOBb6zrAJ3t98MjuYDBStZMHNMiEaoAfQJ4l64Xj2ZGGwvweyVnmijdnSR4pZT6meV/Ad1jxpPpSQUHAAAAAElFTkSuQmCC"></span><span><?=getArrayValue('tel', $result)?></span></li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABS0lEQVQ4T8WTP0sDQRDF3+zeXVA4LBQEiwghBPQEA9vbi4paCBZil8pa/RA2gmU+gRwBQTutrIKwGsE/kEptRBQxBARztztyFsFDhSQEnGZgmPkx84ZHgVJZNtghYBxdBAP3JLFJk0W1T8BxJHHQxTw8S4uWeY6CoqpGEvOuwZIwrYpxvLX3Ib882GhuBPncbhiG5jdwQakR1+CkDfCBhtY6Ukq53/NfW6UAABwAcacnCIPSh4fH9gaG5bp1zGungLrWLz9OSIqdApK+/gMG4jhjhZe3sDNk+YqF8C3MnWQpLCEnmJ+YoMiiGmektsZQ6gtjvv/23GgegTEKoMbMpyTEMpgJ4AqDZokwAcv168vzlYJSwylAokEwrbYBnIGQReQdwmmVvnSJvTLc1ioYtywwdXOh9/qvwf99oVczJd4BeIF6tTMBDzHM1icIkcpJqvoPyQAAAABJRU5ErkJggg=="></span><span><?=getArrayValue('homepage', $result)?></span></li>
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
                    <li><img src="{{ $v['originimgurl'] }}" /></li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
