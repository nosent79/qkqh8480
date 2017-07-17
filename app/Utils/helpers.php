<?php
    /**
     * 페이지 이동
     */
    if (! function_exists('fnMoveUrl')) {
        function fnMoveUrl($msg, $code, $goUrl = '')
        {
            $jsText = '';

            if (! empty($msg)) {
                $jsText .= "alert('".$msg."');" . PHP_EOL;
            }

            switch ($code) {
                case 1:     // 페이지 이동
                    $jsText .= "location.href='".$goUrl."';" . PHP_EOL;
                    break;
                case 2:
                case 3:     // 새 창 닫기
                    $jsText .= "self.close();" .PHP_EOL;
                    break;
                case 4:     // 새 창 닫고 부모창 이동
                    $jsText .= "self.close();" .PHP_EOL;
                    $jsText .= "opener.location.href='".$goUrl."';" .PHP_EOL;
                    break;
                case 5:     // 부모창 닫기
                    $jsText .= "parent.window.close();" .PHP_EOL;
                    break;
                case 6:     // 새 창 닫고 부모창만 리로드
                    $jsText .= "self.close();" .PHP_EOL;
                    $jsText .= "parent.opener.location.reload();" .PHP_EOL;
                    break;
                case 7:     // 부모창만 리로드
                    $jsText .= "self.close();" .PHP_EOL;
                    $jsText .= "opener.location.reload();" .PHP_EOL;
                    break;
                case 8:     // 부모창 리로드 후 페이지 이동
                    $jsText .= "opener.location.reload();" .PHP_EOL;
                    $jsText .= "location.href='".$goUrl."';" . PHP_EOL;
                    break;
            }

            $strJS = "<script>";
            $strJS .= $jsText.PHP_EOL;
            $strJS .= "</script>";

            echo $strJS;
        }
    }

    /**
     * 글자수 줄이기 ...
     */
    if (! function_exists('fnShorten')) {
        function fnShorten($string, $limit = 100, $suffix = '...')
        {
            if (strlen($string) < $limit) {

                return $string;
            }

            return mb_substr($string, 0, $limit) . $suffix;
        }
    }

    /**
     * 현재 달의 초일 구하기
     */
    if (! function_exists('fnGetFirstDay')) {
        function fnGetFirstDay($date, $add_month = 0)
        {
            $date = $date->addMonth($add_month);
            $first_date = date('Y-m-d', mktime(0,0,0,$date->month, 1, $date->year));

            return $first_date;
        }
    }

    /**
     * 현재 달의 말일 구하기
     */
    if (! function_exists('fnGetLastDay')) {
        function fnGetLastDay($date, $add_month = 0)
        {
            $date = $date->addMonth($add_month);
            $last_date = date('Y-m-d', mktime(0,0,0,$date->month+1, 0, $date->year));

            return $last_date;
        }
    }

    /**
     * 날짜 포맷
     */
    if (! function_exists('fnParseDate')) {
        function fnParseDate($date, $format='Y-m-d')
        {
            $pattern = "/(\d{4})(\d{2})(\d{2})/i";
            $replacement='${1}-${2}-${3}';
            $result = preg_replace($pattern, $replacement, $date);

            if (empty($result)) {

                return "";
            }

            return \Carbon\Carbon::parse($result)->format($format);
        }
    }

    /**
     * 날짜 포맷 (한글)
     */
    if (! function_exists('fnParseDateToKor')) {
        function fnParseDateToKor($date, $format='Ymd')
        {
            if ($date === "0000-00-00 00:00:00" || empty($date)) {
                $date = \Carbon\Carbon::now();
            }

            $date = fnParseDate($date, 'Ymd');
            $pattern = "/(\d{4})(\d{2})(\d{2})/i";
            $replacement='${1}년 ${2}월 ${3}일';
            $result = preg_replace($pattern, $replacement, $date);

            if(empty($result)){
                return "";
            }

            return $result;
        }
    }

    /**
     * 날짜 비교 (남은 일 수)
     */
    if (! function_exists('fnDiffRemainDays')) {
        function fnDiffRemainDays($date)
        {
            $result = [];

            $date = fnParseDateToCarbon($date);
            $dt = new \Carbon\Carbon();
            $today = $dt->today();
            $days = $today->diffInDays($date, false);

            if ($days === 0) {
                $result['msg'] = "D-Day";
            } elseif ($days > 0) {
                $result['msg'] = "D-" . $days;
            } else {
                $result['msg'] = "D+" . abs($days);
            }
            $result['days'] = $days;

            return $result;
        }
    }

    /**
     * YYYY-MM-DD to Carbon Object
     */
    if (! function_exists('fnParseDateToCarbon')) {
        function fnParseDateToCarbon($date)
        {
            $date = fnParseDate($date);
            $result = \Carbon\Carbon::parse($date);

            return $result;
        }
    }

    /**
     * 배열 원소 체크하여
     * 존재하면 배열값 리턴
     * 존재하지 않으면 $default 리턴
     */
    if (! function_exists('fnGetArrayValue')) {
        function fnGetArrayValue($index, $arr, $default = '')
        {
            $result = $default;
            if (is_array($arr) && array_key_exists($index, $arr)) {
                $result = $arr[$index];
            }

            return $result;
        }
    }

    /**
     * 선택 메뉴 강조
     */
    if (! function_exists('isSelectedMenu')) {
        function isSelectedMenu($selected, $value)
        {

            return (strpos($value, $selected) ? true : false);
        }
    }

    /**
     * 셀렉트박스 또는 체크박스 선택
     */
    if (! function_exists('getSelectedText')) {
        function getSelectedText($selected, $value, $txt = "selected")
        {
            if (is_array($selected)) {
                if (in_array($value, $selected)) {

                    return $txt;
                }
            } else {

                return ($value === $selected) ? $txt : '';
            }
        }
    }

    if (!function_exists('urlGenerator')) {
        /**
         * @return \Laravel\Lumen\Routing\UrlGenerator
         */
        function urlGenerator() {
            return new \Laravel\Lumen\Routing\UrlGenerator(app());
        }
    }

    if (!function_exists('asset')) {
        /**
         * @param $path
         * @param bool $secured
         *
         * @return string
         */
        function asset($path, $secured = false)
        {
            if (env('APP_ENV') === "production") {
                $path = "/public/" . $path;
            }
            return urlGenerator()->asset($path, $secured);
        }
    }