<?php

/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018. 4. 8.
 * Time: PM 7:48
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Tour;

class TourController
{
    /*
    서비스 명세
        areaCode	        지역코드조회
        categoryCode	    서비스 분류코드 조회
        areaBasedList	    지역기반 관광정보 조회
        locationBasedList	위치기반 관광정보 조회
        searchKeyword	    키워드 검색 조회
        searchFestival	    행사정보 조회
        searchStay	        숙박정보 조회
        detailCommon	    공통정보 조회 (상세정보1)
        detailIntro	        소개정보 조회 (상세정보2)
        detailInfo	        반복정보 조회 (상세정보3)
        detailImage	        이미지정보 조회 (상세정보4)

    콘텐츠타입(contentTypeId)
        관광지	    12
        문화시설	    14
        행사/공연/축제	15
        여행코스	    25
        레포츠	    28
        숙박	        32
        쇼핑	        38
        음식점	    39

    정렬구분(arrange)
        A   제목순
        B   조회순
        C   수정일순
        D   생성일순
    */
    private $request;
    private $tour;

    public function __construct(Request $request, Tour $tour)
    {
        $this->request = $request;
        $this->tour = $tour;
    }

    /**
     * 초기화면
     */
    public function index()
    {
        /*
         * 조회 파라미터
         */
        $numOfRows = $this->request->get('numOfRows', '10');
        $pageNo = $this->request->get('pageNo', '1');
        $MobileOS = $this->request->get('MobileOS', 'ETC');
        $MobileApp = $this->request->get('MobileApp', 'AppTest');
        $listYN = $this->request->get('listYN', 'Y');
        $arrange = $this->request->get('arrange', 'C');
        $contentTypeId = $this->request->get('contentTypeId', '15');
        $areaCode = $this->request->get('areaCode', '');
        $sigunguCode = $this->request->get('sigunguCode', '');

        $date = explode('-', date('Y-m-d'));
        $defaultStartDate = getFirstDay($date, 'Ymd');
        $defaultEndDate = getLastDay($date, 'Ymd');
        $eventStartDate = ($this->request->has('eventStartDate', '')) ? getParseDate($this->request->get('eventStartDate'), 'Ymd') : $defaultStartDate;
        $eventEndDate = ($this->request->has('eventEndDate', '')) ? getParseDate($this->request->get('eventEndDate'), 'Ymd') : $defaultEndDate;

        $_type = $this->request->get('_type', 'json');

        if (empty($MobileOS) || empty($MobileApp) ||
            empty($eventStartDate) || empty($eventEndDate)) {
            echo "정상적인 접근이 아닙니다.";

            exit;
        }

        $info = [];
        $info['searchFestival'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'listYN', 'arrange',
            'contentTypeId', 'areaCode', 'sigunguCode'
            , 'eventStartDate', 'eventEndDate', '_type');

        $this->tour->setParam($info);
        $this->tour->setUrl('searchFestival');

        if ($this->tour->fetchData() === false) {
            echo $this->tour->error->getMessage();
            exit;
        };

        $data = $this->tour->decode();
        if ($data === false) {
            echo $this->tour->error->getMessage() . PHP_EOL;
            echo $this->tour->error->getLine() . PHP_EOL;
            exit;
        }

        $params = [
            'eventStartDate' => $eventStartDate,
            'eventEndDate' => $eventEndDate,
        ];

        return view('api.tour.index', [
            'data'  => $data,
            'param' => $params,
            'tour'  => $this->tour->getService()
        ]);
    }

    public function result()
    {
        $numOfRows = $this->request->get('numOfRows', '10');
        $pageNo = $this->request->get('pageNo', '1');
        $MobileOS = $this->request->get('MobileOS', 'ETC');
        $MobileApp = $this->request->get('MobileApp', 'AppTest');
        $listYN = $this->request->get('listYN', 'Y');
        $arrange = $this->request->get('arrange', 'C');
        $contentTypeId = $this->request->get('contentTypeId', '15');
        $areaCode = $this->request->get('areaCode', '');
        $sigunguCode = $this->request->get('sigunguCode', '');

        // required
        $contentId = $this->request->get('contentId', '');

        // optional
        // detailCommon (공통정보 조회)
        $defaultYN = $this->request->get('defaultYN', 'Y');
        $firstImageYN = $this->request->get('firstImageYN', 'Y');
        $areacodeYN = $this->request->get('areacodeYN', 'Y');
        $catcodeYN = $this->request->get('catcodeYN', 'Y');
        $addrinfoYN = $this->request->get('addrinfoYN', 'Y');
        $mapinfoYN = $this->request->get('mapinfoYN', 'Y');
        $overviewYN = $this->request->get('overviewYN', 'Y');

        // detailIntro (소개정보 조회)
        $introYN = $this->request->get('introYN', 'Y');

        // detailInfo (반복정보 조회)
        $detailYN = $this->request->get('detailYN', 'Y');

        // common
        $_type = $this->request->get('_type', 'json');

        if (empty($contentId)) {
            echo "정상적인 접근이 아닙니다.";

            exit;
        }

        $info = [];

        $info['detailCommon'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'contentId', 'contentTypeId',
            'defaultYN', 'firstImageYN', 'areacodeYN',
            'catcodeYN', 'addrinfoYN', 'mapinfoYN',
            'overviewYN', '_type');

        $info['detailIntro'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'contentId', 'contentTypeId', 'introYN', '_type');

        $info['detailInfo'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'contentId', 'contentTypeId', 'detailYN', '_type');

        $info['detailImage'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'contentId', 'imageYN', 'subImageYN', '_type');

// STEP1.
        $this->tour->setParam($info);
        $this->tour->setContentId($contentId);
        $this->tour->setUrl('detailCommon', 'detailIntro', 'detailInfo', 'detailImage');

        if ($this->tour->fetchData() === false) {
            echo $this->tour->error->getMessage();
            exit;
        }

        $data = $this->tour->decode();
        if ($data === false) {
            echo $this->tour->error->getMessage() . PHP_EOL;
            echo $this->tour->error->getLine() . PHP_EOL;
            exit;
        }

        $result = [];
        $images = [];
        foreach ($this->tour->getService() as $v) {
            $item = $data[$v]['items'];

            if (empty($item)) {
                continue;
            }

            $item = $item['item'];

            if (count($item) !== count($item, 1)) {
                $arrData = [];
                foreach ($item as $vv) {

                    if ($v === 'detailImage') {

                        $images[] = $vv;
                    }
                    $arrData = array_merge($arrData, $vv);
                }

                $result = array_merge($result, $arrData);

            } else {
                $result = array_merge($result, $item);
            }

        }
        return view('api.tour.result', [
            'result'  => $result,
            'images'  => $images
        ]);
    }
}