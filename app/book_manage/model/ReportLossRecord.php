<?php


namespace app\book_manage\model;


use think\Model;

class reportlossrecord extends Model
{
    protected $connection="mysql3";
    protected $pk="RLRId";
    private $BNo;
    private $BLRTime;
    private $isloss;
}