<?php


namespace app\book_manage\model;


use think\Model;

class bookrecoveryrecord extends Model
{
    protected $connection="mysql3";
    protected $pk="BRRId";
    private $Bisbn;
    private $BName;
    private $BerAccount;
    private $BRRTime;
}