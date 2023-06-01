<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;
use think\facade\View;

Route::rule('bookInfo', function () {
    return View::fetch('admin/bookInfo');
});
Route::rule('bookOld', function () {
    return View::fetch('admin/bookOldInfo');
});
Route::rule('bookTypeInfo', function () {
    return View::fetch('admin/bookTypeInfo');
});
Route::rule('borrower', function () {
    return View::fetch('admin/borrowerInfo');
});
Route::rule('bookloss', function () {
    return View::fetch('admin/bookLossInfo');
});
Route::rule('bookBorrowerRecordView', function () {
    return View::fetch('admin/bookBorrow_record');
});
Route::rule('bookReView', function () {
    return View::fetch('admin/bookReViewInfo');
});

//图书类型添加
Route::rule('addBookTypeView', function () {
    return View::fetch('add/addBookType');
});
Route::rule('PressInfo', function () {
    return View::fetch('admin/pressInfo');
});
Route::rule('addPressInfoView', function () {
    return View::fetch('add/addPressInfo');
});
Route::rule('addBorrowerView', 'admin/addBorrowerView');


//个人中心
Route::rule('upPersonInfo',"admin/personal_userinfo");
Route::rule('upPersonPwd', function () {
    return View::fetch('update/upPersonalPwd');
});

//登陆
Route::rule('login',"admin/login_user");
Route::rule('register_data','admin/register');
Route::rule('islogin',"admin/login_server");

Route::rule('isregister',"admin/register_data");

Route::rule('index_show',"admin/index");
Route::rule('login_exit',"admin/exit_login");


//用户
Route::rule("userView","user/userView");

Route::rule("details","user/details");



Route::rule('user_login_exit',"user/exit_login");
Route::redirect('/', '/index.php/book_manage/login');

