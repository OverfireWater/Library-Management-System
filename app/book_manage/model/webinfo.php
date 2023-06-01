<?php


namespace app\book_manage\model;


use think\Model;

class webinfo extends Model
{
    protected $connection="mysql3";
    private $webname;
    private $book_num;
}