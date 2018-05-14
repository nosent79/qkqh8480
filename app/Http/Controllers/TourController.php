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

    public function areaBasedList()
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
//dd($result);
        return view('api.sightseeing.result', [
            'result'  => $result,
            'images'  => $images
        ]);
    }

    public function camping()
    {
        $numOfRows = $this->request->get('numOfRows', '10');
        $pageNo = $this->request->get('pageNo', '1');
        $MobileOS = $this->request->get('MobileOS', 'ETC');
        $MobileApp = $this->request->get('MobileApp', 'AppTest');
        $listYN = $this->request->get('listYN', 'Y');
        $arrange = $this->request->get('arrange', 'C');
        $contentTypeId = $this->request->get('contentTypeId', 28);
        $areaCode = $this->request->get('areaCode', '');
        $sigunguCode = $this->request->get('sigunguCode', '');
        $cat1 = $this->request->get('cat1', 'A03');
        $cat2 = $this->request->get('cat2', 'A0302');
        $cat3 = $this->request->get('cat3', 'A03021700');
        $keyword = $this->request->get('keyword', '캠핑');
        $_type = $this->request->get('_type', 'json');

        $info = [];
        $info['searchKeyword'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'listYN', 'arrange', 'contentTypeId', 'areaCode', 'sigunguCode',
            'cat1', 'cat2', 'cat3', 'keyword', '_type');

        $this->tour->setParam($info);
        $this->tour->setUrl('searchKeyword');
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

        $totalCnt = $data[$this->tour->getService()[0]]['totalCount'];

        $PagePerBlock = 10;

        $pageNum = ceil($totalCnt / $numOfRows);  // 총 페이지
        $blockNum = ceil($pageNum / $PagePerBlock); // 총 블록
        $nowBlock = ceil($pageNo / $PagePerBlock);

        $s_page = ($nowBlock * $PagePerBlock) - ($PagePerBlock - 1);

        if ($s_page <= 1) {
            $s_page = 1;
        }
        $e_page = $nowBlock*$PagePerBlock;
        if ($pageNum <= $e_page) {
            $e_page = $pageNum;
        }

        $pageInfo = compact('pageNo', 'PagePerBlock','PagePerblock', 'pageNum', 'blockNum', 'nowBlock', 's_page', 'e_page');
        $pageParams = http_build_query(compact('arrange', 'contentTypeId', 'cat1', 'cat2', 'cat3', 'keyword', 'areaCode'));

        return view('api.camping.index', [
            'data'  => $data,
            'params' => $info['searchKeyword'],
            'tour'  => $this->tour->getService(),
            'pages' => $pageInfo,
            'pageParams' => $pageParams
        ]);
    }

    /**
     * 캠핑장 정보 조회
     *
     * @return \Illuminate\View\View
     */
    public function campingDetail()
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

        return view('api.camping.result', [
            'result'  => $result,
            'images'  => $images
        ]);
    }

    public function sightseeing()
    {
        $numOfRows = $this->request->get('numOfRows', '50');
        $pageNo = $this->request->get('pageNo', '1');
        $MobileOS = $this->request->get('MobileOS', 'ETC');
        $listYN = $this->request->get('listYN', 'Y');
        $arrange = $this->request->get('arrange', 'C');
        $MobileApp = $this->request->get('MobileApp', 'AppTest');
        $contentTypeId = $this->request->get('contentTypeId', 12);
        $areaCode = $this->request->get('areaCode', '');
        $sigunguCode = $this->request->get('sigunguCode', '');
        $cat1 = $this->request->get('cat1', '');
        $cat2 = $this->request->get('cat2', '');
        $cat3 = $this->request->get('cat3', '');
        $_type = $this->request->get('_type', 'json');

        if (empty($contentTypeId)) {
            echo "정상적인 접근이 아닙니다.";

            exit;
        }

        $info = [];
        $info['areaBasedList'] = compact(
            'numOfRows', 'pageNo', 'MobileOS',
            'MobileApp', 'listYN', 'arrange', 'contentTypeId', 'areaCode', 'sigunguCode',
            'cat1', 'cat2', 'cat3', '_type');

        $this->tour->setParam($info);
        $this->tour->setUrl('areaBasedList');

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

        $totalCnt = $data[$this->tour->getService()[0]]['totalCount'];

        $PagePerBlock = 10;

        $pageNum = ceil($totalCnt / $numOfRows);  // 총 페이지
        $blockNum = ceil($pageNum / $PagePerBlock); // 총 블록
        $nowBlock = ceil($pageNo / $PagePerBlock);

        $s_page = ($nowBlock * $PagePerBlock) - ($PagePerBlock - 1);

        if ($s_page <= 1) {
            $s_page = 1;
        }
        $e_page = $nowBlock*$PagePerBlock;
        if ($pageNum <= $e_page) {
            $e_page = $pageNum;
        }

        $pageInfo = compact('pageNo', 'PagePerBlock','PagePerblock', 'pageNum', 'blockNum', 'nowBlock', 's_page', 'e_page');
        $pageParams = http_build_query(compact('arrange', 'contentTypeId', 'areaCode'));

        return view('api.sightseeing.index', [
            'data'  => $data,
            'params' => $info['areaBasedList'],
            'tour'  => $this->tour->getService(),
            'pages' => $pageInfo,
            'pageParams' => $pageParams
        ]);
    }

    /**
     * 초기화면
     */
    public function index()
    {
        /*
         * 조회 파라미터
         */
        $numOfRows = $this->request->get('numOfRows', '50');
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
        $eventStartDate = getParseDate($this->request->get('eventStartDate', $defaultStartDate), 'Ymd');
        $eventEndDate = getParseDate($this->request->get('eventEndDate', $defaultEndDate), 'Ymd');

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

        $totalCnt = $data[$this->tour->getService()[0]]['totalCount'];

        $PagePerBlock = 10;

        $pageNum = ceil($totalCnt / $numOfRows);  // 총 페이지
        $blockNum = ceil($pageNum / $PagePerBlock); // 총 블록
        $nowBlock = ceil($pageNo / $PagePerBlock);

        $s_page = ($nowBlock * $PagePerBlock) - ($PagePerBlock - 1);

        if ($s_page <= 1) {
            $s_page = 1;
        }
        $e_page = $nowBlock*$PagePerBlock;
        if ($pageNum <= $e_page) {
            $e_page = $pageNum;
        }

        $pageInfo = compact('pageNo', 'PagePerBlock','PagePerblock', 'pageNum', 'blockNum', 'nowBlock', 's_page', 'e_page');
        $pageParams = http_build_query(compact('arrange', 'contentTypeId', 'eventStartDate', 'eventEndDate'));

        return view('api.tour.index', [
            'data'  => $data,
            'params' => $info['searchFestival'],
            'tour'  => $this->tour->getService(),
            'pages' => $pageInfo,
            'pageParams' => $pageParams
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
