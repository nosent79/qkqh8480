<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #list li dt {
            cursor:pointer;
        }
    </style>
</head>
<body>
<div>
    <div>
        <form id="frmTourDetail" name="frmTourDetail">
            <input type="hidden" name="contentId" />
        </form>
        <form id="frmTour" name="frmTour" method="post">
            <select name="contentTypeId">
                <option value="12">관광지</option>
                <option value="14">문화시설</option>
                <option value="15" selected="selected">행사/공연/축제</option>
                <option value="25">여행코스</option>
                <option value="28">레포츠</option>
                <option value="32">숙박</option>
                <option value="36">쇼핑</option>
                <option value="39">음식점</option>
            </select>

            <select name="arrange">
                <option value="A">제목순</option>
                <option value="B" selected="selected">조회순</option>
                <option value="C">수정일순</option>
                <option value="D">생성일순</option>
            </select>
            <input type="date" name="eventStartDate" value="<?=getParseDate($param['eventStartDate'], "Y-m-d")?>"/>
            <input type="date" name="eventEndDate" value="<?=getParseDate($param['eventEndDate'], "Y-m-d")?>"/>

            <button id="btnSubmit">검색</button>
        </form>
    </div>
    <div id="list">
        <ul>
            <?php
            foreach ($tour as $v) {
            $items = $data[$v]['items']['item'];
            foreach ($items as $item) {
            ?>
            <li>
                <dl>
                    <dt data-seq="<?= $item['contentid'] ?>"><?= $item['title'] ?></dt>
                    <dd><?= $item['tel'] ?></dd>
                    <dd><?= $item['readcount'] ?></dd>
                    <dd><?= getParseDate($item['eventstartdate'], "Y.m.d") . " ~ " . getParseDate($item['eventenddate'], "Y.m.d")?></dd>
                </dl>
            </li>
            <?php
            }
            }
            ?>

        </ul>
    </div>
</div>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $("#list li dt").on("click", function () {
        $('input[name=contentId]').val($(this).data('seq'));

        $("#frmTourDetail")
            .attr('method', 'post')
            .attr('action', "{{ route('api.tour.result') }}")
            .submit();
    })
</script>
</body>
</html>