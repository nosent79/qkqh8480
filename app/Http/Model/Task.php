<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 4:42
 */
namespace app\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $dates = ['del_date', 'reg_date', 'upd_date'];
    protected $fillable = [''];
    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}