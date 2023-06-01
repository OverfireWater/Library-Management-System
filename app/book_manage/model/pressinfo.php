<?php


namespace app\book_manage\model;


use think\Model;

class pressinfo extends Model
{
    protected $connection="mysql3";
    protected $pk="PressId";
    private $PressName;
    private $remark;
}