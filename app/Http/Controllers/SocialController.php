<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-11
 * Time: 오후 1:59
 */
namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SocialController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 초기화면
     */
    public function index()
    {
        return "Here is SocialController index";
    }

    public function callback_naver()
    {
        return "Here is SocialController callback for naver";
    }
}