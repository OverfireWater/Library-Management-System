<?php


namespace app\book_manage\model;


use think\Model;

class booktypeinfo extends Model
{
    protected $connection="mysql3";
    private $BTName;
    private $BTRemark;
}