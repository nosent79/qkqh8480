<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2017-07-04
 * Time: 오후 5:05
 */

namespace app\Http\Model;


class Member
{
    protected $table = 'members';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id', 'user_name', 'user_pwd', 'user_email'];
    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}