<?php


namespace app\book_manage\model;


use think\Model;

class bookinfo extends Model
{
    protected $connection="mysql3";
    private $BNo;
    private $Bisbn;
    private $BName;
    private $BTId;
    private $BPressId;
    private $BAuthor;
    private $BPrice;
    private $BIsOld;
    private $BState;
    private $BUrl;
    private $SRemark;
    public function booktype(){
        return $this->hasOne(booktypeinfo::class,"id","BTId");
    }
    public function pressinfo(){
        return $this->hasOne(pressinfo::class,"PressId","BPressId");
    }
}