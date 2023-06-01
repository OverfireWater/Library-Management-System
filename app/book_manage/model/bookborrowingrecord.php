<?php


namespace app\book_manage\model;


use think\Model;

class bookborrowingrecord extends Model
{
    protected $connection="mysql3";
    protected $pk="BBRId";
    private $BNo;
    private $BerAccount;
    private $BerStartTime;
    private $BerEndTime;
    private $isborrow;
    public function bookinfo(){
        return $this->hasOne(bookinfo::class,"BNo","BNo");
    }
}