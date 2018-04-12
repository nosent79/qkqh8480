
@php
    header("Content-Type: text/plain");

    $contentTypeId['12'] = [
        'accomcount' => '수용인원',
        'chkbabycarriage' => '유모차 대여 여부',
        'chkcreditcard' => '신용카드 가능 여부',
        'chkpet' => '애완동물 가능 여부',
        'expagerange' => '체험가능 연령',
        'expguide' => '체험안내',
//            'heritage1' => '세계 기록유산 유무1',
//            'heritage2' => '세계 기록유산 유무2',
//            'heritage3' => '세계 기록유산 유무3',
        'infocenter' => '문의 및 안내',
        'opendate' => '개장일',
        'parking' => '주차시설',
        'restdate' => '쉬는날',
        'useseason' => '이용시기',
        'usetime' => '이용시간',
    ];

    $contentTypeId['14'] = [
        'accomcountculture' => '수용인원',
        'chkbabycarriageculture' => '유모차 대여 여부',
        'chkcreditcardculture' => '신용카드 가능 여부',
        'chkpetculture' => '애완동물 가능 여부',
        'discountinfo' => '할인정보',
        'infocenterculture' => '문의 및 안내',
        'parkingculture' => '주차시설',
        'parkingfee' => '주차요금',
        'restdateculture' => '쉬는날',
        'usefee' => '이용요금',
        'usetimeculture' => '이용시간',
        'scale' => '규모',
        'spendtime' => '관람 소요시간',
    ];

    $contentTypeId['15'] = [
        'agelimit' => '관람 가능연령',
        'bookingplace' => '예매처',
        'discountinfofestival' => '할인정보',
        'eventenddate' => '행사 종료일',
        'eventhomepage' => '행사 홈페이지',
        'eventplace' => '행사 장소',
        'eventstartdate' => '행사 시작일',
        'festivalgrade' => '축제등급',
        'placeinfo' => '행사장 위치안내',
        'playtime' => '공연시간',
        'program' => '행사 프로그램',
        'spendtimefestival' => '관람 소요시간',
        'sponsor1' => '주최자 정보',
        'sponsor1tel' => '주최자 연락처',
        'sponsor2' => '주관사 정보',
        'sponsor2tel' => '주관사 연락처',
        'subevent' => '부대행사',
        'usetimefestival' => '이용요금',
    ];

    $contentTypeId['25'] = [
        'distance' => '코스 총거리',
        'infocentertourcourse' => '문의 및 안내',
        'schedule' => '코스 일정',
        'taketime' => '코스 총 소요시간',
        'theme' => '코스 테마',
    ];

    $contentTypeId['28'] = [
        'accomcountleports' => '수용인원',
        'chkbabycarriageleports' => '유모차 대여 여부',
        'chkcreditcardleports' => '신용카드 가능 여부',
        'chkpetleports' => '애완동물 가능 여부',
        'expagerangeleports' => '체험 가능연령',
        'infocenterleports' => '문의 및 안내',
        'openperiod' => '개장기간',
        'parkingfeeleports' => '주차요금',
        'parkingleports' => '주차시설',
        'reservation' => '예약안내',
        'restdateleports' => '쉬는날',
        'scaleleports' => '규모',
        'usefeeleports' => '입장료',
        'usetimeleports' => '이용시간',
    ];

    $contentTypeId['32'] = [
        'accomcountlodging' => '수용 가능인원',
        'benikia' => '베니키아 여부',
        'checkintime' => '입실 시간',
        'checkouttime' => '퇴실 시간',
        'chkcooking' => '객실내 취사 여부',
        'foodplace' => '식음료장',
        'goodstay' => '굿스테이 여부',
        'hanok' => '한옥 여부',
        'infocenterlodging' => '문의 및 안내',
        'parkinglodging' => '주차시설',
        'pickup' => '픽업 서비스',
        'roomcount' => '객실수',
        'reservationlodging' => '예약안내',
        'reservationurl' => '예약안내 홈페이지',
        'roomtype' => '객실유형',
        'scalelodging' => '규모',
        'subfacility' => '부대시설 (기타)',
        'barbecue' => '바비큐장 여부',
        'beauty' => '뷰티시설 정보',
        'beverage' => '식음료장 여부',
        'bicycle' => '자전거 대여 여부',
        'campfire' => '캠프파이어 여부',
        'fitness' => '휘트니스 센터 여부',
        'karaoke' => '노래방 여부',
        'publicbath' => '공용 샤워실 여부',
        'publicpc' => '공용 PC실 여부',
        'sauna' => '사우나실 여부',
        'seminar' => '세미나실 여부',
        'sports' => '스포츠 시설 여부',
    ];

    $contentTypeId['38'] = [
        'chkbabycarriageshopping' => '유모차 대여 여부',
        'chkcreditcardshopping' => '신용카드 가능 여부',
        'chkpetshopping' => '애완동물 가능 여부',
        'culturecenter' => '문화센터 바로가기',
        'fairday' => '장서는 날',
        'infocentershopping' => '문의 및 안내',
        'opendateshopping' => '개장일',
        'opentime' => '영업시간',
        'parkingshopping' => '주차시설',
        'restdateshopping' => '쉬는날',
        'restroom' => '화장실 설명',
        'saleitem' => '판매 품목',
        'saleitemcost' => '판매 품목별 가격',
        'scaleshopping' => '규모',
        'shopguide' => '매장안내',
    ];

    $contentTypeId['39'] = [
        'chkcreditcardfood' => '신용카드 가능 여부',
        'discountinfofood' => '할인정보',
        'firstmenu' => '대표 메뉴',
        'infocenterfood' => '문의 및 안내',
        'kidsfacility' => '어린이 놀이방 여부',
        'opendatefood' => '개업일',
        'opentimefood' => '영업시간',
        'packing' => '포장 가능',
        'parkingfood' => '주차시설',
        'reservationfood' => '예약안내',
        'restdatefood' => '쉬는날',
        'scalefood' => '규모',
        'seat' => '좌석수',
        'smoking' => '금연/흡연 여부',
        'treatmenu' => '취급 메뉴',
    ];

    $detailInfo['25'] = [
        'subcontentid' => '하위 콘텐츠ID',
        'subdetailalt' => '코스이미지 설명',
        'subdetailimg' => '코스이미지',
        'subdetailoverview' => '코스개요',
        'subname' => '코스명',
        'subnum' => '반복 일련번호',
    ];

    $detailInfo['25'] = [
        'roomcode' => '객실코드',
        'roomtitle' => '객실명칭',
        'roomsize1' => '객실크기(평)',
        'roomcount' => '객실수$',
        'roombasecount' => '기인원',
        'roommaxcount' => '최대인원',
        'roomoffseasonminfee1' => '비수기주중최소',
        'roomoffseasonminfee2' => '비수기주말최소',
        'roompeakseasonminfee1' => '성수기주중최소',
        'roompeakseasonminfee2' => '성수기주말최소',
        'roomintro' => '객실소개',
        'roombathfacility' => '목욕시설 여부',
        'roombath' => '욕조 여부',
        'roomhometheater' => '홈시어터 여부',
        'roomaircondition' => '에어컨 여부',
        'roomtv' => 'TV 여부',
        'roompc' => 'PC 여부',
        'roomcable' => '케이블설치 여부',
        'roominternet' => '인터넷 여부',
        'roomrefrigerator' => '냉장고 여부',
        'roomtoiletries' => '세면도구 여부',
        'roomsofa' => '소파 여부',
        'roomcook' => '취사용품 여부',
        'roomTable' => '테이블 여부',
        'roomhairdryer' => '드라이기 여부',
        'roomsize2' => '객실크기(평방미터)',
        'roomimg1' => '객실사진1',
        'roomimg1alt' => '객실사진1 설명',
        'roomimg2' => '객실사진2',
        'roomimg2alt' => '객실사진2 설명',
        'roomimg3' => '객실사진3',
        'roomimg3alt' => '객실사진3 설명',
        'roomimg4' => '객실사진4',
        'roomimg4alt' => '객실사진4 설명',
        'roomimg5' => '객실사진5',
        'roomimg5alt' => '객실사진5 설명',
    ];
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
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACh0lEQVQ4T4WTz0tUURTHv+c+m3H+gCDn3ft0YUFohFibcBFUSEUbIwuDFhEF0U+IihZF9JNoY0aK/RCkEqWiCBfmJsmFkYtaFAQSzbvvPgfbhITNz3vijTORZXV3h/O9H875nnMI/35UTvPfZBXBgryUcpUQfJUZTQBHmrfW0mljzLvfQX8APM/dwIweIXAslTIjAFgptRGwXYA9pPX0i18hCwANDQ2x2dmv75lpe3X13OdsNnGEmZ2qqlintZkks/MsHk80Tk1NZSuQBQCl1FqAL2odtErp9gvBvcUiFYTAca3NTind58y4ZIyZWBTgee4OgDf5frhfKXdIa9MeCZVKPtE6bFPKvQXwK63DgUUBZfP6fd80eZ48xcxLmbkA4HsQhOeVSr5hFieE4CaiqsFUKjX9s4Vy/3sBdDHTriAIHiulGq21TuS+5yW3MdNTACEzvhHxNa3DvhJASrmciCN3x5hpiIi7i0VuCcNQR/na2toaawuviWgglytcj8WczQCv8f3wSAmgVPIgQFJrc2Y+lncBXqG1WR+NUUp3VAga9/3g3HxeNQK2R2vTUgJ4XvI2QCO+bx5VAEQ2zkyfAGSJEO3GuNbmbNk8R0o3DAJTU65AThKJdt/3ow9Qyu3LZHKHE4nYZBRbS+sAvhIE5kDFfaXcCWuxh5qbm5fMzKS11mZZXV1ddbGY6yCik9bSBcexH/J5zIVh+FEpeUfrYN+8JzUrrRX3mekyua67Wgh+QCSGmXk3gFEiDDNjC4BWgMaI+KG1aHccDFqLo8xQRHyTWdwjKWUbEd8A0J3PF3vT6fSXSpn19fXxTCazVQjuKANfAqJTax1NrHShlT0QUav/Oe1FNT8AxhI8nTGoDh0AAAAASUVORK5CYII="></span><span><?=getArrayValue('addr1', $result)?></span></li>
                <li>&nbsp;</li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAB+0lEQVQ4T42SO4gTURSG/3MnM3GNksLAyDw22cjCCoJFEGxELRRB8LVqIbKt2GihWLiwVgrCNtoKFhY+QFhYsFgU7RTBRqwTsnNnriaFIhizs/M4MpsERWUnp7lw7n++8+AnDKNSqWwvlYr7VleDNwB4lM97KRPU6/VyFIUrw0KhafrJdrv9Ja84+yfLsrZqGr0G+LmUanFy0r7ETFeYccD3/a95EHIcZ1aI9LTnqYsjsevad5i55Pvqai6gWjWn0rTwQspgD4A0K3Ac64YQdNDzguO5gEzgus4SkD6TUj11XddiTt8aRnFvq9X6PhagVrNmkoRWhCjs7/V6PyYmis319Xiq0+n0xgJkosHxMCtlcMx17XlmTPt+MDc2YLC7/QhA3/eDy45jvxSClj3Pv7cZZMMHo2g0Gnq3+3kZoA9RlNzXdW0JwEdN068JIYpxHD4GuAkUbnme923DB3/TTdMsGUYhM9V7TdPnkyS6DeAcgJCZHxBRGaBThhEdbjY73X8AGbBWq21JkvghwNvW1tYvlMvlKAzDHVJKNbpXmmLONHce+i9gNJXjWAtEdCZJ+IRSyvtzWte13xHxwqaAYbfzzLgL8E0p1ZOBb6zrAJ3t98MjuYDBStZMHNMiEaoAfQJ4l64Xj2ZGGwvweyVnmijdnSR4pZT6meV/Ad1jxpPpSQUHAAAAAElFTkSuQmCC"></span><span><?=getArrayValue('tel', $result)?></span></li>
                <li>&nbsp;</li>
                <li><span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABS0lEQVQ4T8WTP0sDQRDF3+zeXVA4LBQEiwghBPQEA9vbi4paCBZil8pa/RA2gmU+gRwBQTutrIKwGsE/kEptRBQxBARztztyFsFDhSQEnGZgmPkx84ZHgVJZNtghYBxdBAP3JLFJk0W1T8BxJHHQxTw8S4uWeY6CoqpGEvOuwZIwrYpxvLX3Ib882GhuBPncbhiG5jdwQakR1+CkDfCBhtY6Ukq53/NfW6UAABwAcacnCIPSh4fH9gaG5bp1zGungLrWLz9OSIqdApK+/gMG4jhjhZe3sDNk+YqF8C3MnWQpLCEnmJ+YoMiiGmektsZQ6gtjvv/23GgegTEKoMbMpyTEMpgJ4AqDZokwAcv168vzlYJSwylAokEwrbYBnIGQReQdwmmVvnSJvTLc1ioYtywwdXOh9/qvwf99oVczJd4BeIF6tTMBDzHM1icIkcpJqvoPyQAAAABJRU5ErkJggg=="></span><span><?=getArrayValue('homepage', $result)?></span></li>
            </ul>
        </div>
    </div>

    <div id="tourSummary" class="tourSection">
        <div class="title">개요</div>
        <div class="content"><?=getArrayValue('overview', $result)?></div>
    </div>

    <div id="tourDetail" class="tourSection">
        <div class="title">정보</div>
        <div class="content">
            <ul>
                @if(! in_array($result['contenttypeid'], ['25', '32']))
                    <li><em>내용</em><span><?=getArrayValue('infotext', $result)?></span></li>
                @else
                    @foreach($detailInfo[$result['contenttypeid']] as $k => $v)
                        @if(isset($result[$k]))
                            <li><em>{{ $v }}</em><span>{!! getArrayValue($k, $result) !!}</span></li>
                        @endif
                    @endforeach

                @endif
            </ul>
        </div>
    </div>

    <div id="tourUse" class="tourSection">
        <div class="title">이용안내</div>
        <div class="content">
            <ul>
                @foreach($contentTypeId[$result['contenttypeid']] as $k => $v)
                    @if(isset($result[$k]))
                        <li><em>{{ $v }}</em><span>{!! getArrayValue($k, $result) !!}</span></li>
                    @endif
                @endforeach
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
                        <li><img width="300" src="{{ $v['originimgurl'] }}" /></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
