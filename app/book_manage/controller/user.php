<?php


namespace app\book_manage\controller;


use app\BaseController;
use app\book_manage\model\bookborrowingrecord;
use app\book_manage\model\bookinfo;
use app\book_manage\model\booktypeinfo;
use app\book_manage\model\borrowerinfo;
use app\book_manage\model\reportlossrecord;
use app\book_manage\model\reviewinfo;
use app\book_manage\model\webinfo;
use think\facade\Session;
use think\facade\View;
class user extends BaseController
{
    public function userView()
    {
        if (Session::has("userBorrowInfo")) {
            $userinfo = session('userBorrowInfo');
            $pwd = $userinfo['pwd'];
            $userId = $userinfo['userId'];
            $userName = $userinfo['username'];
            $role = $userinfo['role'];
            //判断是否有账号登陆，并且账号并没更改
            $count = borrowerinfo::where(['id' => $userId, "BerAccount" => $userName, "BerPwd" => $pwd, "BerRole" => $role])->count();
            if ($count) {
                $requst = request()->param();
                $keywords=$requst['keywords']??'';
                $state=$requst['state']??'';
                $userinfo = session('userBorrowInfo');
                $userId = $userinfo['userId'];
                $BerName = $userinfo['BerName'];
                $account = $userinfo['username'];
                //获取首页显示的条数
                $webInfo=webinfo::find(1);
                //获取借阅人的信息
                $userinfo_res = borrowerinfo::where(['id' => $userId, "BerAccount" => $userName, "BerPwd" => $pwd, "BerRole" => $role])->find()->toArray();
                //获取类型信息
                $bookType = booktypeinfo::select()->toArray();
                //获取书籍信息
                $bookInfo = bookinfo::withJoin(["booktype","pressinfo"])->where("BState",'like','%'.$state.'%')->where("BName|BAuthor|BTName|PressName", 'like', '%' . $keywords . '%')->order("id","desc")->paginate(['list_rows'=>$webInfo->book_num,'query' => ["keywords"=>$keywords,"state"=>$state]]);
                $book_total = $bookInfo->toArray()['total'];
                //获取书籍分页显示
                $page = $bookInfo->render();
                //获取借阅人的书籍信息，并且展示
                $book_count = bookborrowingrecord::withJoin("bookinfo")->where(["BerAccount" => $account, "isborrow" => 0, "bookinfo.BState" => 2])->count();
                if ($book_count) {
                    $bookborrow_bookInfo = bookborrowingrecord::withJoin("bookinfo")->where(["BerAccount" => $account, "bookinfo.BState" => 2, 'isborrow' => 0])->select()->toArray();
                } else {
                    $bookborrow_bookInfo = "暂无借阅的图书";
                }
                $book_count = bookborrowingrecord::withJoin("bookinfo")->where(["BerAccount" => $account, "isborrow" => 0, "BState" => 2])->select()->count();
                View::assign(['name' => $BerName, "phone" => $userinfo_res['BerPhone'], 'bookType' => $bookType, "total" => $book_total, "bookInfo" => $bookInfo->toArray()['data'], "page" => $page, "keywords" => $keywords, "myborrow_book" => $bookborrow_bookInfo, "mybook_count" => $book_count,"state"=>$state]);
                View::assign(["webInfo"=>$webInfo]);
                return View::fetch("user/index");
            } else {
                \session(null);
                return redirect('/index.php/book_manage/login');
            }
        } else {
            return redirect('/index.php/book_manage/login');
        }
    }

    public function exit_login()
    {
        session("userBorrowInfo", null);
        return redirect('/index.php/book_manage/login');
    }

    public function details()
    {
        $res = request()->param();
        $id = $res['b_id'];
        $state = $res['state'];
        $userinfo = session('userBorrowInfo');
        $account=$userinfo['username'];
        $book_bno=bookinfo::where("id",$id)->find()->BNo;
        $book_borrow_cord=bookborrowingrecord::where(["BNo"=>$book_bno,"BerAccount"=>$account])->find();
        $BerName = $userinfo['BerName'];
        $bookInfo = bookinfo::where("id", $id)->find();
        $bookInfo = $bookInfo->toArray() + $bookInfo->booktype->toArray();
        //书评
        $BNo = $bookInfo["BNo"];
        $reviewInfo = reviewinfo::withJoin("borrower")->where("BNo", $BNo)->count();
        if ($reviewInfo) {
            $reviewInfo = reviewinfo::withJoin("borrower")->where("BNo", $BNo)->select()->toArray();
        } else {
            $reviewInfo = "没有评论";
        }
        //查询网站名称
        $webInfo=webinfo::find(1);
        View::assign(["bername" => $BerName, "state" => $state, "bookInfo" => $bookInfo, 'borrow' => $res['borrow'], "review" => $reviewInfo,"book_borrower_cord"=>$book_borrow_cord]);
        View::assign(['webInfo'=>$webInfo]);
        return View::fetch('user/details');
    }

    public function open_date_select()
    {
        $bookId = request()->param("bookId");
        $bookNO = request()->param("bookNO");
        View::assign(["bookId" => $bookId, "bookNO" => $bookNO]);
        return View::fetch("user/date_select");
    }

    //借书
    public function borrowing_book()
    {
        $res = request()->param();
        $bookNO = $res['bookNO'];
        $bookId = $res['bookId'];
        $datetime = date("Y-m-d H:i:s");
        $bookstate_res = bookinfo::where(["id" => $bookId, "BState" => 2])->count();
        if (!$bookstate_res) {
            $return_datetime = $res['datetime'];
            $userInfo = session("userBorrowInfo");
            $borrow_res = bookborrowingrecord::insert(["BNo" => $bookNO, "BerAccount" => $userInfo['username'], "BerStartTime" => $datetime, "BerEndTime" => $return_datetime]);
            $book_res = bookinfo::where("id", $bookId)->update(["BState" => 2]);
            if ($borrow_res && $book_res) {
                $arr = array("code" => 0, "msg" => "图书借阅成功，请前往图书馆领取");
                exit(json_encode($arr));
            } else {
                $arr = array("code" => 1, "msg" => "图书借阅失败，请重新借阅");
                exit(json_encode($arr));
            }
        } else {
            $arr = array("code" => 1, "msg" => "图书已经被借阅，请换本图书借阅");
            exit(json_encode($arr));
        }
    }

    public function return_book()
    {
        $res = request()->param();
        $bookNo = $res['bookNo'];
        $borrow = $res['borrow'];
        $borrow_res = bookborrowingrecord::where("BNo", $bookNo)->update(['isborrow' => $borrow]);
        $bookinfo_res = bookinfo::where("BNo", $bookNo)->update(['BState' => $borrow]);
        if ($borrow_res && $bookinfo_res) {
            $arr = array("code" => 0, "msg" => "图书归还成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "图书归还失败或者已经归还");
            exit(json_encode($arr));
        }
    }

    //续借
    public function open_date_renew_select()
    {
        $bookId = request()->param("bookId");
        $bookNO = request()->param("bookNO");
        View::assign(["bookId" => $bookId, "bookNO" => $bookNO]);
        return View::fetch("user/renew_select");
    }

    public function renew_book()
    {
        $res = request()->param();
        $bookNo = $res['bookNo'];
        $datetime = $res['datetime'];
        $userinfo = session('userBorrowInfo');
        $account = $userinfo['username'];
        $borrow_res = bookborrowingrecord::where('BNo', $bookNo)->update(['BerEndTime' => $datetime]);
        if ($borrow_res) {
            $arr = array("code" => 0, "msg" => "图书续借成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "图书续借失败或者已经续借了");
            exit(json_encode($arr));
        }
    }

    //挂失
    public function loss_book()
    {
        $res = request()->param();
        $bookNo = $res['bookNo'];
        $borrow = $res['borrow'];
        $date = date("Y-m-d H:i:s");
        $borrow_res = reportlossrecord::insert(['BNo' => $bookNo, 'BLRTime' => $date, 'isloss' => $borrow]);
        $bookinfo_res = bookinfo::where("BNo", $bookNo)->update(['BState' => $borrow]);
        if ($borrow_res && $bookinfo_res) {
            $arr = array("code" => 0, "msg" => "图书挂失成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "图书挂失失败或者已经挂失");
            exit(json_encode($arr));
        }
    }

    //书评
    public function re_view_info()
    {
        $res = request()->param();
        $userinfo = session('userBorrowInfo');
        $account = $userinfo['username'];
        $datetime = date("Y-m-d H:i:s");
        $bookname=bookinfo::where("BNo",$res['BNo'])->find();
        $bookname=$bookname->BName;
        $review_res = reviewInfo::insert(["BNo" => $res['BNo'],"bookName"=>$bookname, "RContent" => $res['text'], "RDateTime" => $datetime, "BerAccount" => $account]);
        if ($review_res) {
            $arr = array("code" => 0);
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1);
            exit(json_encode($arr));
        }
    }

    public function up_personal_userinfo()
    {
        $userinfo = session('userBorrowInfo');
        $userId = $userinfo['userId'];
        $account=$userinfo['username'];
        $pwd=$userinfo['pwd'];
        $role=$userinfo['role'];
        $res = request()->param();
        $userInfo_res = borrowerinfo::where("id", $userId)->update(['BerName' => $res['name'],"BerPhone" => $res['phone']]);
        if ($userInfo_res) {
            session("userBorrowInfo", ['userId' => $userId, 'username' => $account, 'pwd' => $pwd,"BerName"=>$res['name'],"role"=>$role]);
            $arr = array("code" => 0, "msg" => "修改成功");
            echo json_encode($arr) ;
        } else {
            $arr = array("code" => 1, "msg" => "修改失败");
            exit(json_encode($arr));
        }
    }


    public function up_pwd()
    {
        $userinfo = session('userBorrowInfo');
        $userId = $userinfo['userId'];
        $res = request()->param();
        $userInfo_res = borrowerinfo::where("id", $userId)->update(["BerPwd" => $res['pwd']]);
        if ($userInfo_res) {
            $arr = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "修改失败");
            exit(json_encode($arr));
        }

    }
}
