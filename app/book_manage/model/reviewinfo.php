<?php


namespace app\book_manage\model;


use think\Model;

class reviewinfo extends Model
{
    protected $connection="mysql3";
    protected $pk="RId";
    private $BNo;
    private $RContent;
    private $RDateTime;
    private $BerAccount;
    private $RSupport;
    private $RHidden;
    public function borrower(){
        return $this->hasOne(borrowerinfo::class,"BerAccount","BerAccount");
    }
}