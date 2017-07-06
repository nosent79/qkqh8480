<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-06
 * Time: 오전 11:35
 */

namespace App\Exceptions;

use Exception;
use Throwable;

class CustomException extends Exception
{
    public $message;
    public $code;
    public $url;

    public function __construct($message = "", $code = 0, $url = null)
    {
        $this->message = $message;
        $this->code = $code;
        $this->url = $url;
    }

    public function __toString()
    {
        $jsText = "";
        switch ($this->code) {
            case 3:
                $jsText = "self.close();";
                break;
            case 1:
            default:
                $jsText = "document.location.href='".$this->url."';";
        }

        $strJS = "<script>" . PHP_EOL;
        if (! empty($this->message)) {
            $strJS .= "alert('" . $this->message. "')" . PHP_EOL;
        }
        $strJS .= $jsText . PHP_EOL;
        $strJS .= "</script>";

        return $strJS;
    }
}