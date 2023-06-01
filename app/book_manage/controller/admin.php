<?php

namespace app\book_manage\controller;

use app\BaseController;
use app\book_manage\model\bookborrowingrecord;
use app\book_manage\model\bookinfo;
use app\book_manage\model\bookrecoveryrecord;
use app\book_manage\model\booktypeinfo;
use app\book_manage\model\borrowerinfo;
use app\book_manage\model\pressinfo;
use app\book_manage\model\reportlossrecord;
use app\book_manage\model\reviewinfo;
use app\book_manage\model\webinfo;
use think\facade\Session;
use think\facade\View;

class admin extends BaseController
{
    public function index()
    {
        if (Session::has("userInfo")) {
            $userinfo = session('userInfo');
            $pwd = $userinfo['pwd'];
            $userId = $userinfo['userId'];
            $userName = $userinfo['username'];
            $role = $userinfo['role'];
            $count = borrowerinfo::where(['id' => $userId, "BerAccount" => $userName, "BerPwd" => $pwd, "BerRole" => $role])->count();
            $webInfo = webinfo::find(1);
            if ($count) {
                View::assign(["user" => $userinfo, "webInfo" => $webInfo]);
                return View::fetch("admin/index");
            } else {
                \session(null);
                return redirect("login");
            }
        } else {
            return redirect("login");
        }

    }

    public function login_user()
    {
        $webInfo = webinfo::find(1);
        return View::fetch("login/index", ["webInfo" => $webInfo]);
    }

    public function register()
    {
        $webInfo = webinfo::find(1);
        return View::fetch("login/register", ["webInfo" => $webInfo]);
    }

    public function register_data()
    {
        $res = request()->param();
        $datetime = date("Y-m-d H:i:s");
        $card=$res['card'];
        $phone=$res['phone'];
        if(strlen($phone)==11){
            if (strlen($card)==18){
                $card_res = borrowerinfo::where("BerCardId", $res['card'])->count();
                if (!$card_res) {
                    $phone_res = borrowerinfo::where("BerPhone", $res['phone'])->count();
                    if (!$phone_res) {
                        $bor_res = borrowerinfo::insert(['BerAccount' => $res['phone'], "BerPwd" => $res['pwd'], "BerName" => $res['name'], "BerCardId" => $res['card'], "BerPhone" => $res['phone'], "BerRole" => 1, "BerBTime" => $datetime]);
                        if ($bor_res) {
                            $array = array("code" => 1, "msg" => "<br /><br /><br /><br />注册成功<br /><br />");
                        } else {
                            $array = array("code" => 0, "msg" => "账号名或密码错误");
                        }
                    } else {
                        $array = array("code" => 0, "msg" => "手机号已存在，请重新输入");
                    }
                } else {
                    $array = array("code" => 0, "msg" => "身份证已存在，请重新输入");
                }
            }else{
                $array = array("code" => 0, "msg" => "身份证输入错误，请重新输入");
            }
        }else{
            $array = array("code" => 0, "msg" => "手机号输入错误，请重新输入");
        }

        echo json_encode($array);
    }

    public function login_server()
    {
        //用户登陆判断
        $res = request()->param();
        $name = $res['name'];
        $pwd = $res['pwd'];
        $count_res = borrowerinfo::where(['BerAccount' => $name, "BerPwd" => $pwd])->count();
        if ($count_res) {
            $user_res = borrowerinfo::where(['BerAccount' => $name, "BerPwd" => $pwd])->find()->toArray();
            $userId = $user_res['id'];
            $userName = $user_res['BerName'];
            $role = $user_res['BerRole'];
            if ($role == 1 || $role == 2) {
                session("userBorrowInfo", ['userId' => $userId, 'username' => $name, 'pwd' => $pwd, "BerName" => $userName, "role" => $role]);
            } else {
                session("userInfo", ['userId' => $userId, 'username' => $name, 'pwd' => $pwd, "BerName" => $userName, "role" => $role]);
            }
            $array = array("code" => 1, "role" => $user_res['BerRole'], "msg" => "<br /><br /><br /><br />登陆成功<br /><br />欢迎回来");
            echo json_encode($array);
        } else {
            $array = array("code" => 0, "msg" => "<br /><br />账号名或密码错误");
            echo json_encode($array);
        }

    }

    public function exit_login()
    {
        session("userInfo", null);
        return redirect('/index.php/book_manage/login');
    }

    /*数据表 --开头
    */
    public function book_data()
    {
        //书籍数量
        $book_count = bookinfo::count();
        //仓库数量
        $book_0_count = bookinfo::where("BState", 0)->count();
        //上架 1
        $book_1_count = bookinfo::where("BState", 1)->count();
        //外借 2
        $book_2_count = bookinfo::where("BState", 2)->count();
        //挂失 3
        $book_3_count = bookinfo::where("BState", 3)->count();
        //报废 4
        $book_4_count = bookinfo::where("BState", 4)->count();
        //借阅人
        $borrower_count = borrowerinfo::whereIn("BerRole", [1, 2])->count();
        //未归还的书
        $book_record_count = bookborrowingrecord::where("isborrow", 0)->count();
        //网站信息
        $webInfo = webinfo::find(1)->toArray();
        $array = array("book_count" => $book_count, "can_count" => $book_0_count, "shang" => $book_1_count, "jie" => $book_2_count, "gua" => $book_3_count, "baofei" => $book_4_count, "borrower" => $borrower_count, "book_record" => $book_record_count);
        View::assign($array);
        View::assign("webInfo", $webInfo);
        return View::fetch("admin/welcome");
    }

    //修改数据表
    public function up_data_webinfo()
    {
        if (request()->isPost()) {
            $res = request()->param();
            $webInfo_res = webinfo::where('id', $res['id'])->update(["webname" => $res['name'], "book_num" => $res['number']]);
            if ($webInfo_res) {
                $arr = array("code" => 0, "msg" => "修改成功");
            } else {
                $arr = array("code" => 1, "msg" => "修改失败，请检查是否修改了数据");
            }
        } else {
            $arr = array("code" => 1, "msg" => "请求数据不合法");
        }
        exit(json_encode($arr));
    }
    /*数据表 --结尾
    */

    /*图书信息表 --开头
    *包含增删改查，搜索查询
    */
    public function get_bookInfo_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $arr = bookinfo::withJoin(["booktype", "pressinfo"])->where('BNo|BName|BAuthor|BTName|PressName', 'like', '%' . $keywords . '%')->order("id", "desc")->paginate($limit)->toArray();
        if ($arr['total'] > 0) {
            for ($i = 0; $i < count($arr['data']); $i++) {
                $array[$i] = $arr['data'][$i] + $arr['data'][$i]['booktype'] + $arr['data'][$i]['pressinfo'];
            }
            foreach ($array as &$subarr) {
                unset($subarr['booktype']);
                unset($subarr['pressinfo']);
            }
            unset($subarr);
            $count = $arr['total'];
            $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $array);
            exit(json_encode($array));
        } else {
            $array = array("code" => 0, "msg" => "没有数据", "count" => 1);
            exit(json_encode($array));
        }

    }

    public function addBookInfoView()
    {
        $bookType = booktypeinfo::select()->toArray();
        $pressInfo = pressinfo::select()->toArray();
        View::assign(['booktypeinfo' => $bookType, "pressinfo" => $pressInfo]);
        return View::fetch("add/addBookInfo");
    }

    public function addBookInfo()
    {

        $res = request()->param();
        // 获取表单上传文件
        $files = request()->file();
        try {
            validate(['file' => 'fileExt:jpg,png'])->check($files);
            $files = request()->file('file');
            $file = app('file_system');
            $file_name = $file->upload($files);
            $file_name = str_replace("\\", "/", $file_name);
            $file_name = "/storage/" . $file_name;
            $datetime = date("Y-m-d H:i:s");
            $book_bno = bookinfo::order("id", "desc")->find()->toArray();
            $book_bno = $book_bno['BNo'] + 1;
            $bookInfo_res = bookinfo::insert(["BNo" => $book_bno, "Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "BState" => 0, "BUrl" => $file_name, "SRemark" => $res['remark']]);
            if ($res['isNew'] == 1) {
                $bookRecovery_res = bookrecoveryrecord::insert(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BerAccount" => $res['donation'], "BRRTime" => $datetime]);
            }
            if ($bookInfo_res || $bookRecovery_res) {
                $arr = array("code" => 0, "msg" => "添加成功");
            } else {
                $arr = array("code" => 1, "msg" => "添加失败");
            }
            exit(json_encode($arr));
        } catch (\think\exception\ValidateException $e) {
            $arr = array("code" => 2, "msg" => "图片类型错误，请重新上传");
            exit(json_encode($arr));
        }
    }


    public function upBookStateView()
    {
        $res = request()->param();
        return View::fetch("update/upBookState", ["id" => $res['id'], "stateId" => $res['stateId']]);
    }

    //更改图书状态
    public function upBookState()
    {
        $res = request()->param();
        $book_bno = bookinfo::find($res['id']);
        $datetime = date("Y-m-d H:i:s");
        if ($res['state'] == 3) {
            $book_loss_count = reportlossrecord::where(["BNo" => $book_bno->BNo])->count();
            if ($book_loss_count) {
                $book_loss = reportlossrecord::where(["BNo" => $book_bno->BNo])->update(["BLRTime" => $datetime, "isloss" => 0]);
            } else {
                $book_loss = reportlossrecord::insert(["BNo" => $book_bno->BNo, "BLRTime" => $datetime, "isloss" => 0]);
            }
            $bookInfo_res = bookinfo::where("id", $res['id'])->update(['BState' => $res['state']]);
            if ($bookInfo_res && $book_loss) {
                $arr = array("code" => 0, "msg" => "修改成功");
            } else {
                $arr = array("code" => 1, "msg" => "修改失败,请重新尝试提交数据");
            }
            exit(json_encode($arr));
        } else
            if ($res['state'] == 1) {
                $book_loss_count = reportlossrecord::where(["BNo" => $book_bno->BNo, "isloss" => 0])->count();
                if ($book_loss_count) {
                    $loss_res = reportlossrecord::where(["BNo" => $book_bno->BNo, "isloss" => 0])->update(["isloss" => $res['state']]);
                }
                $book_type_res = bookinfo::where("id", $res['id'])->update(['BState' => $res['state']]);
                if ($book_type_res) {
                    $arr = array("code" => 0, "msg" => "修改成功");
                } else {
                    $arr = array("code" => 1, "msg" => "修改失败,请重新尝试提交数据");
                }
                exit(json_encode($arr));
            } else {
                $book_type_res = bookinfo::where("id", $res['id'])->update(['BState' => $res['state']]);
                if ($book_type_res) {
                    $arr = array("code" => 0, "msg" => "修改成功");
                } else {
                    $arr = array("code" => 1, "msg" => "修改失败,请重新尝试提交数据");
                }
                exit(json_encode($arr));
            }
    }

    public
    function upBookInfoView()
    {
        $id = request()->param("id");
        $bookType = booktypeinfo::select()->toArray();
        $pressInfo = pressinfo::select()->toArray();
        $bookInfo = bookinfo::where("id", $id)->find();
        $bisbn = $bookInfo->Bisbn;
        $isOld = $bookInfo->BIsOld;
        if ($isOld == "1") {
            $bookrecovery = bookrecoveryrecord::where("Bisbn", $bisbn)->find();
            View::assign(['id' => $id, 'booktypeinfo' => $bookType, "pressinfo" => $pressInfo, "bookinfo" => $bookInfo->toArray(), "isOld" => $isOld, "bookOldAccount" => $bookrecovery->BerAccount]);
        } else {
            View::assign(['id' => $id, 'booktypeinfo' => $bookType, "pressinfo" => $pressInfo, "bookinfo" => $bookInfo->toArray(), "isOld" => $isOld, "bookOldAccount" => "无"]);
        }
        return View::fetch("update/upBookInfo");
    }

    public
    function upBookInfo()
    {
        $res = request()->param();
        // 获取表单上传文件
        $files = request()->file();
        if (isset($files['file'])) {
            try {
                validate(['file' => 'fileExt:jpg,png'])->check($files);
                $bookImg = bookinfo::where("id", $res['id'])->find();
                $bookImg = $bookImg->BUrl;
                try {
                    unlink(root_path("public" . $bookImg));
                } catch (\Exception $e) {
                }
                $files = request()->file('file');
                $file = app('file_system');
                $file_name = $file->upload($files);
                $file_name = str_replace("\\", "/", $file_name);
                $file_name = "/storage/" . $file_name;
                if ($res['isNew'] == 0) {
                    $bookIsbn = bookinfo::where("id", $res['id'])->find();
                    $isbn = $bookIsbn->Bisbn;
                    $count_res = bookrecoveryrecord::where("Bisbn", $isbn)->count();
                    if ($count_res) {
                        $de_bookRecovery = bookrecoveryrecord::where("Bisbn", $isbn)->delete();
                        $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "BUrl" => $file_name, "SRemark" => $res['remark']]);
                        if ($bookInfo_res || $de_bookRecovery) {
                            $arr = array("code" => 0, "msg" => "修改成功");
                            exit(json_encode($arr));
                        } else {
                            $arr = array("code" => 1, "msg" => "修改失败");
                            exit(json_encode($arr));
                        }
                    } else {
                        $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "BUrl" => $file_name, "SRemark" => $res['remark']]);
                        if ($bookInfo_res) {
                            $arr = array("code" => 0, "msg" => "修改成功");
                            exit(json_encode($arr));
                        } else {
                            $arr = array("code" => 1, "msg" => "修改失败");
                            exit(json_encode($arr));
                        }
                    }
                } else {
                    $datetime = date("Y-m-d H:i:s");
                    $bookIsbn = bookinfo::where("id", $res['id'])->find();
                    $isbn = $bookIsbn->Bisbn;
                    $count_res = bookrecoveryrecord::where("Bisbn", $isbn)->count();
                    if ($count_res) {
                        $bookRecovery = bookrecoveryrecord::where("Bisbn", $isbn)->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BerAccount" => $res['account'], "BRRTime" => $datetime]);
                        $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "BUrl" => $file_name, "SRemark" => $res['remark']]);
                        if ($bookInfo_res || $bookRecovery) {
                            $arr = array("code" => 0, "msg" => "修改成功");
                            exit(json_encode($arr));
                        } else {
                            $arr = array("code" => 1, "msg" => "修改失败");
                            exit(json_encode($arr));
                        }
                    } else {
                        $bookRecovery = bookrecoveryrecord::insert(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BerAccount" => $res['account'], "BRRTime" => $datetime]);
                        $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "BUrl" => $file_name, "SRemark" => $res['remark']]);
                        if ($bookInfo_res || $bookRecovery) {
                            $arr = array("code" => 0, "msg" => "修改成功");
                            exit(json_encode($arr));
                        } else {
                            $arr = array("code" => 1, "msg" => "修改失败");
                            exit(json_encode($arr));
                        }
                    }

                }
            } catch (\think\exception\ValidateException $e) {
                $arr = array("code" => 2, "msg" => "图片类型错误，请重新上传");
                exit(json_encode($arr));
            }
        } else {
            if ($res['isNew'] == 0) {
                $bookIsbn = bookinfo::where("id", $res['id'])->find();
                $isbn = $bookIsbn->Bisbn;
                $count_res = bookrecoveryrecord::where("Bisbn", $isbn)->count();
                if ($count_res) {
                    $de_bookRecovery = bookrecoveryrecord::where("Bisbn", $isbn)->delete();
                    $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "SRemark" => $res['remark']]);
                    if ($bookInfo_res || $de_bookRecovery) {
                        $arr = array("code" => 0, "msg" => "修改成功");
                        exit(json_encode($arr));
                    } else {
                        $arr = array("code" => 1, "msg" => "修改失败");
                        exit(json_encode($arr));
                    }
                } else {
                    $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "SRemark" => $res['remark']]);
                    if ($bookInfo_res) {
                        $arr = array("code" => 0, "msg" => "修改成功");
                        exit(json_encode($arr));
                    } else {
                        $arr = array("code" => 1, "msg" => "修改失败");
                        exit(json_encode($arr));
                    }
                }
            } else {
                $datetime = date("Y-m-d H:i:s");
                $bookIsbn = bookinfo::where("id", $res['id'])->find();
                $isbn = $bookIsbn->Bisbn;
                $count_res = bookrecoveryrecord::where("Bisbn", $isbn)->count();
                if ($count_res) {
                    $bookRecovery = bookrecoveryrecord::where("Bisbn", $isbn)->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BerAccount" => $res['account'], "BRRTime" => $datetime]);
                    $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "SRemark" => $res['remark']]);
                    if ($bookInfo_res || $bookRecovery) {
                        $arr = array("code" => 0, "msg" => "修改成功");
                        exit(json_encode($arr));
                    } else {
                        $arr = array("code" => 1, "msg" => "修改失败");
                        exit(json_encode($arr));
                    }
                } else {
                    $bookRecovery = bookrecoveryrecord::insert(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BerAccount" => $res['account'], "BRRTime" => $datetime]);
                    $bookInfo_res = bookinfo::where("id", $res['id'])->update(["Bisbn" => $res['isbn'], "BName" => $res['title'], "BTId" => $res['bookType'], "BPressId" => $res['press'], "BAuthor" => $res['author'], "BPrice" => $res['price'], "BIsOld" => $res['isNew'], "SRemark" => $res['remark']]);
                    if ($bookInfo_res || $bookRecovery) {
                        $arr = array("code" => 0, "msg" => "修改成功");
                        exit(json_encode($arr));
                    } else {
                        $arr = array("code" => 1, "msg" => "修改失败");
                        exit(json_encode($arr));
                    }
                }

            }
        }
    }

    public
    function deBookInfo()
    {
        $id = request()->param('id');
        $bookImg = bookinfo::where("id", $id)->find();
        $Img = $bookImg->BUrl;
        $bookOld = $bookImg->BIsOld;
        $bookBisbn = $bookImg->Bisbn;
        try {
            unlink(root_path("public" . $Img));
        } catch (\Exception $e) {
        }
        if ($bookOld == 1) {
            $deOld_book = bookrecoveryrecord::where("Bisbn", $bookBisbn)->delete();
        }
        $res = bookinfo::where('id', $id)->whereRaw('BState=0 OR BState=1')->delete();
        if ($res) {
            $arr = array("code" => 0, "msg" => "删除成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "删除失败,该书不在仓库或上架状态");
            exit(json_encode($arr));
        }
    }

    /*图书信息表 --结尾
    *包含增删改查，搜索查询
    */

    /*旧书记录 --结尾
        *包含增删改查，搜索查询
        */

    public
    function get_bookOld_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $depart = bookrecoveryrecord::where('Bisbn|BName|BerAccount', 'like', '%' . $keywords . '%')->order("BRRId", "desc")->paginate($limit)->toArray();
        $count = $depart['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $depart['data']);
        exit(json_encode($array));
    }

    /*旧书记录表 --结尾
    *包含增删改查，搜索查询
    */


    /*图书类型信息表 --开头
    *包含增删改查，搜索查询
    */

    public
    function get_booktype_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $depart = booktypeinfo::where('BTName|BTRemark', 'like', '%' . $keywords . '%')->order("id", "desc")->paginate($limit)->toArray();
        $count = $depart['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $depart['data']);
        exit(json_encode($array));
    }

    public
    function addBookType()
    {
        $role = request()->param();
        $role_res = booktypeinfo::insert(['BTName' => $role['type'], 'BTRemark' => $role['remark']]);
        if ($role_res) {
            $arr = array("code" => 0, "msg" => "添加成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "添加失败");
            exit(json_encode($arr));
        }
    }

    public
    function upBookTypeView()
    {
        $id = request()->param('id');
        $role = booktypeinfo::where('id', $id)->find()->toArray();
        View::assign(["id" => $id, "bookType" => $role]);
        return View::fetch('update/upBookType');
    }

    public
    function upBookType()
    {
        $role = request()->param();
        $res = booktypeinfo::where('id', $role['id'])->update(['BTName' => $role['type'], 'BTRemark' => $role['remark']]);
        if ($res) {
            $arr = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "修改失败");
            exit(json_encode($arr));
        }
    }

    public
    function deBookType()
    {
        $id = request()->param('id');
        $book_res = bookinfo::where("BTId", $id)->count();
        if ($book_res) {
            $arr = array("code" => 1, "msg" => "删除失败,此类型有图书正在使用");
            exit(json_encode($arr));
        } else {
            $res = booktypeinfo::where('id', $id)->delete();
            if ($res) {
                $arr = array("code" => 0, "msg" => "删除成功");
            } else {
                $arr = array("code" => 1, "msg" => "删除失败");
            }
            exit(json_encode($arr));
        }

    }

    /*图书类型信息表 --结尾
    *包含增删改查，搜索查询
    */


    /*图书出版社信息表 --开头
    *包含增删改查，搜索查询
    */

    public
    function get_pressInfo_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $arr = pressinfo::where("PressName", "like", "%" . $keywords . "%")->order("PressId", "desc")->paginate($limit)->toArray();
        $count = $arr['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $arr['data']);
        exit(json_encode($array));
    }

    public
    function addPressInfo()
    {
        $role = request()->param();
        $role_res = pressinfo::insert(['PressName' => $role['name'], 'remark' => $role['remark']]);
        if ($role_res) {
            $arr = array("code" => 0, "msg" => "添加成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "添加失败");
            exit(json_encode($arr));
        }
    }

    public
    function upPressInfoView()
    {
        $id = request()->param('id');
        $role = pressinfo::where('PressId', $id)->find()->toArray();
        View::assign(["id" => $id, "bookType" => $role]);
        return View::fetch('update/upPressInfo');
    }

    public
    function upPressInfo()
    {
        $role = request()->param();
        $res = pressinfo::where('PressId', $role['id'])->update(['PressName' => $role['name'], 'remark' => $role['remark']]);
        if ($res) {
            $arr = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "修改失败");
            exit(json_encode($arr));
        }
    }

    public
    function de_PressInfo()
    {
        $res = request()->param();
        $book_res = bookinfo::where("BPressId", $res['id'])->count();
        if ($book_res) {
            $arr = array("code" => 1, "msg" => "删除失败,此出版社信息有图书正在使用");
            exit(json_encode($arr));
        } else {
            $re_loss = pressinfo::where("PressId", $res['id'])->delete();
            if ($re_loss) {
                $arr = array("code" => 0, "msg" => "删除成功");
            } else {
                $arr = array("code" => 1, "msg" => "删除失败");
            }
            exit(json_encode($arr));
        }
    }

    /*图书出版社信息表 --结尾
    *包含增删改查，搜索查询
    */

    /*借阅人信息表 --开头
    *包含增删改查，搜索查询
    */

    public
    function get_borrower_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $arr = borrowerinfo::where("id|BerAccount|BerName|BerCardId|BerPhone", "like", "%" . $keywords . "%")->order("id", "desc")->paginate($limit)->toArray();
        $count = $arr['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $arr['data']);
        exit(json_encode($array));
    }

    public
    function addBorrowerView()
    {
        $adminInfo = session("userInfo");
        if ($adminInfo['role'] == 3) {
            $flag = false;
        } else {
            $flag = true;
        }
        return View::fetch("add/addborrowerInfo", ["role" => $flag]);
    }

    public
    function addBorrower()
    {
        $res = request()->param();
        $phone=$res['phone'];
        $cardId=$res['cardId'];
        if (strlen($phone)==11){
            if(strlen($cardId)==18){
                $phone_res = borrowerinfo::where("BerPhone", $phone)->count();
                if (!$phone_res) {
                    $card_res = borrowerinfo::where("BerCardId", $cardId)->count();
                    if (!$card_res) {
                        $count_res = borrowerinfo::insert(['BerAccount' => $phone, 'BerPwd' => $res['pwd'], "BerName" => $res['name'], "BerCardId" => $cardId, "BerPhone" => $phone, "BerRole" => $res['role']]);
                        if ($count_res) {
                            $array = array("code" => 0, "msg" => "添加成功");
                        } else {
                            $array = array("code" => 1, "msg" => "添加失败");
                        }
                        exit(json_encode($array));
                    } else {
                        $array = array("code" => 1, "msg" => "身份证已存在，请重新输入");
                    }
                } else {
                    $array = array("code" => 1, "msg" => "账号或手机号已存在，请重新输入");
                }
            }else{
                $array = array("code" => 1, "msg" => "身份证输入错误，请重新输入");
            }
        }else{
            $array = array("code" => 1, "msg" => "手机号输入错误，请重新输入");
        }


        exit(json_encode($array));
    }

    public
    function borrowerRole()
    {
        $userInfo = session("userInfo");
        $arr = array("code" => 0, "data" => $userInfo);
        exit(json_encode($arr));
    }

    public
    function upBorrowerView()
    {
        $id = request()->param('id');
        $userInfo = session("userInfo");
        $data_res = borrowerinfo::where("id", $id)->find()->toArray();
        if ($userInfo['role'] == 3) {
            $flag = false;
        } else {
            $flag = true;
        }
        View::assign(["id" => $id, "data" => $data_res, "flag" => $flag]);
        return View::fetch('update/upborrowerInfo');
    }

    public
    function upBorrower()
    {
        $res = request()->param();
        $role = $res['role'];
        $role_res = borrowerinfo::find($res['id']);
        $phone=$res['phone'];
        $cardId=$res['cardId'];
        if (strlen($phone)==11){
            if(strlen($cardId)==18){
                if ($role == $role_res->BerRole) {
                    $count_res = borrowerinfo::where("id", $res['id'])->update(['BerAccount' => $res['account'], "BerName" => $res['name'], "BerCardId" =>$cardId, "BerPhone" => $phone, "BerRole" => $res['role']]);
                    if ($count_res) {
                        $arr = array("code" => 0, "msg" => "修改成功");
                    } else {
                        $arr = array("code" => 1, "msg" => "修改失败");
                    }
                    exit(json_encode($arr));
                } else {
                    $book_borrower = bookborrowingrecord::where(["BerAccount" => $res['account'], "isborrow" => 0])->count();
                    if (!$book_borrower) {
                        $count_res = borrowerinfo::where("id", $res['id'])->update(['BerAccount' => $res['account'], "BerName" => $res['name'], "BerCardId" =>$cardId, "BerPhone" => $phone, "BerRole" => $res['role']]);
                        if ($count_res) {
                            $arr = array("code" => 0, "msg" => "修改成功");
                        } else {
                            $arr = array("code" => 1, "msg" => "修改失败");
                        }
                    } else {
                        $arr = array("code" => 1, "msg" => "修改权限失败，当前用户的书籍正在借阅中");
                    }
                }
            }else{
                $arr = array("code" => 1, "msg" => "身份证修改失败，请检查后在提交");
            }
        }else{
            $arr = array("code" => 1, "msg" => "手机号修改失败，请检查后在提交");
        }
        exit(json_encode($arr));
    }


    public
    function deBorrower()
    {
        $res = request()->param();
        $userinfo = session('userInfo');
        $role = $userinfo['role'];
        if ($role == 0) {
            $count = borrowerinfo::where(['id' => $res['id'], "BerRole" => 0])->count();
            if (!$count) {
                $res = borrowerinfo::where(['id' => $res['id']])->delete();
                if ($res) {
                    $arr = array("code" => 0, "msg" => "删除成功");
                } else {
                    $arr = array("code" => 1, "msg" => "删除失败");
                }
                exit(json_encode($arr));
            } else {
                $arr = array("code" => 1, "msg" => "删除失败,您不能删除管理员");
                exit(json_encode($arr));
            }
        } else {
            $arr = array("code" => 1, "msg" => "你没有该权限");
            exit(json_encode($arr));
        }

    }

    /*借阅人信息表 --结尾
    *包含增删改查，搜索查询
    */

    /*借阅信息表 --开头
    *包含增删改查，搜索查询
    */

    public
    function get_borrow_record_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $arr = bookborrowingrecord::where("BNo|BerAccount|BerStartTime|BerEndTime", "like", "%" . $keywords . "%")->order("BBRId", "desc")->paginate($limit)->toArray();
        $count = $arr['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $arr['data']);
        exit(json_encode($array));
    }

    /*借阅信息表 --结尾
    *包含增删改查，搜索查询
    */

    /*挂失信息表 --开头
    *包含增删改查，搜索查询
    */

    public
    function get_book_loss_data()
    {
        $keywords = request()->param("keywords");
        $keywords = $keywords == "未找到" ? "0" : "1";
        $limit = request()->param("limit");
        $arr = reportlossrecord::where("BNo|isloss|BLRTime", "like", "%" . $keywords . "%")->order("RLRId", "desc")->paginate($limit)->toArray();
        $count = $arr['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $arr['data']);
        exit(json_encode($array));
    }

//更改图书丢失
    public
    function upSwich_bookloss()
    {
        $res = request()->param();
        $BNo = $res['BNo'];
        $RLRId = $res['RLRId'];
        $flag = $res['flag'];
        if ($flag == 'true') {
            $statu = 1;
            $state = 1;
        } else {
            $statu = 0;
            $state = 3;
        }
        $res = reportlossrecord::where("RLRId", $RLRId)->update(["isloss" => $statu]);
        $book_res = bookinfo::where("BNo", $BNo)->update(["BState" => $state]);
        if ($res && $book_res) {
            $arr = array("code" => 0, "msg" => "修改成功");
        } else {
            $arr = array("code" => 1, "msg" => "修改失败");
        }
        exit(json_encode($arr));
    }

    public
    function de_bookloss()
    {
        $res = request()->param();
        $re_loss = reportlossrecord::where("RLRId", $res['id'])->delete();
        if ($re_loss) {
            $arr = array("code" => 0, "msg" => "删除成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "删除失败");
            exit(json_encode($arr));
        }
    }

    /*挂失信息表 --结尾
    *包含增删改查，搜索查询
    */

    /*评论信息表 --开头
       *包含增删改查，搜索查询
       */

    public
    function get_reView_data()
    {
        $keywords = request()->param("keywords");
        $limit = request()->param("limit");
        $arr = reviewinfo::where("BNo|bookName|BerAccount|RDateTime", "like", "%" . $keywords . "%")->order("RId", "desc")->paginate($limit)->toArray();
        $count = $arr['total'];
        $array = array("code" => 0, "msg" => "", "count" => $count, "data" => $arr['data']);
        exit(json_encode($array));
    }

    public
    function de_reView()
    {
        $res = request()->param();
        $re_loss = reviewinfo::where("RId", $res['id'])->delete();
        if ($re_loss) {
            $arr = array("code" => 0, "msg" => "删除成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "删除失败");
            exit(json_encode($arr));
        }
    }

    /*评论信息表 --结尾
    *包含增删改查，搜索查询
    */

    /*
     * 个人中心修改
     * */

    public
    function personal_userinfo()
    {
        $userinfo = session('userInfo');
        $userId = $userinfo['userId'];
        $userinfo_res = borrowerinfo::where('id', $userId)->find()->toArray();
        View::assign("userInfo", $userinfo_res);
        return View::fetch("update/upPersonalUserInfo");
    }

    public
    function up_personal_userinfo()
    {
        $userinfo = session('userInfo');
        $userId = $userinfo['userId'];
        $res = request()->param();
        $userInfo_res = borrowerinfo::where("id", $userId)->update(['BerName' => $res['name'], "BerCardId" => $res['cardId'], "BerPhone" => $res['phone']]);
        if ($userInfo_res) {
            $arr = array("code" => 0, "msg" => "修改成功");
            exit(json_encode($arr));
        } else {
            $arr = array("code" => 1, "msg" => "修改失败");
            exit(json_encode($arr));
        }
    }

    /*
     * 个人中心修改
     * */

    /*
     * 修改密码
     * */
    public
    function up_pwd()
    {
        $userinfo = session('userInfo');
        $userId = $userinfo['userId'];
        $res = request()->param();
        $count = borrowerinfo::where(['id' => $userId, "BerPwd" => $res['oldPwd']])->count();
        if ($count) {
            $userInfo_res = borrowerinfo::where("id", $userId)->update(["BerPwd" => $res['newPwd']]);
            if ($userInfo_res) {
                $arr = array("code" => 0, "msg" => "修改成功");
                exit(json_encode($arr));
            } else {
                $arr = array("code" => 1, "msg" => "修改失败");
                exit(json_encode($arr));
            }
        } else {
            $arr = array("code" => 2, "msg" => "原密码错误");
            exit(json_encode($arr));
        }

    }
    /*
     * 修改密码
     * */
}


