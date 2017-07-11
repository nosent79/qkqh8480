<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-11
 * Time: 오후 1:59
 */
namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Model\Memo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemoController extends Controller
{
    private $memo;
    private $request;

    public function __construct(Request $request, Memo $memo)
    {
        $this->request = $request;
        $this->memo = $memo;
    }

    /**
     * 공통 메모 등록 폼
     */
    public function register()
    {
        $memo = collect($this->memo->getMemo());

        return view('memo.register', ['memo' => $memo]);
    }

    /**
     * 공통 메모 등록 처리
     */
    public function registerOK()
    {
        try {
            $params = collect($this->request->all());

            $rstTask = $this->memo->setMemo($params);
            if ($rstTask === false) {
                throw new CustomException('메모 등록이 실패했습니다.', '1', route('task.index'));
            }

            fnMoveUrl('정상적으로 처리되었습니다.', 1, route('memo.register'));
        } catch (CustomException $e) {
            echo $e;
        } catch (\Exception $e) {
            Log::error(__METHOD__. $e);

            fnMoveUrl('오류가 발생했습니다.', 1, route('memo.register'));
        }
    }

    /**
     * 공통 메모 보기
     */
    public function view()
    {
        $memo = collect($this->memo->getMemo());
        $memo->put('memo', nl2br($memo->get('memo')));

        return response()->json($memo);
    }
}