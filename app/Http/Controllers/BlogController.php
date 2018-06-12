<?php
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 2018. 5. 29.
 * Time: PM 12:12
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController
{
    private $request;
    private $tour;

    public function __construct(Request $request, Tour $tour)
    {
        $this->request = $request;
        $this->tour = $tour;
    }

    public function blogIndex()
    {
        /*
         * 조회 파라미터
         */
        $numOfRows = $this->request->get('numOfRows', '50');
        $pageNo = $this->request->get('pageNo', '1');
        $MobileOS = $this->request->get('MobileOS', 'ETC');
        $MobileApp = $this->request->get('MobileApp', 'AppTest');
        $listYN = $this->request->get('listYN', 'Y');
        $arrange = $this->request->get('arrange', 'Q');
        $contentTypeId = $this->request->get('contentTypeId', '15');
        $areaCode = $this->request->get('areaCode', '');
        $sigunguCode = $this->request->get('sigunguCode', '');

        $_type = $this->request->get('_type', 'json');

        $info = [];
        $info['areaBasedList'] = compact(
            'numOfRows', 'pageNo', 'MobileOS', 'MobileApp',
            'listYN', 'arrange', 'contentTypeId', 'areaCode', 'sigunguCode',
            'cat1', 'cat2', 'cat3', '_type');
        $services = ['areaBasedList'];
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
        $pageParams = http_build_query(compact('arrange', 'contentTypeId'));

        return view('api.blog.blogIndex', [
            'data'  => $data,
            'params' => $info['areaBasedList'],
            'tour'  => $this->tour->getService(),
            'pages' => $pageInfo,
            'pageParams' => $pageParams
        ]);


    }

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
        $arrange = $this->request->get('arrange', 'Q');
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

        return view('api.blog.index', [
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

        return view('api.blog.result', [
            'result'  => $result,
            'images'  => $images
        ]);
    }
}