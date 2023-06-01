<?php


namespace app\book_manage\model;


use think\Model;

class borrowerinfo extends Model
{
    protected $connection="mysql3";
    private $BerAccount;
    private $BerPwd;
    private $BerName;
    private $BerCardId;
    private $BerPhone;
    private $BerRole;
    private $BerBTime;
}