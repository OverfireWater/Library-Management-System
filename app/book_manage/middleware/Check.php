<?php


namespace app\book_manage\middleware;

use think\facade\Request;
use think\facade\Session;

class Check
{
    public function handle(\think\Request $request, \Closure $next)
    {
        $the_url=Request::url();
        $url="/index.php/book_manage/login";
        if (!$request->post() && !$request->get()){
            if (Session::has("userInfo") || Session::has("userBorrowInfo")){
                return $next($request);
            }else if ($the_url==$url){
                return $next($request);
            }else{
                return redirect("/index.php/book_manage/login");
            }
        }else{
            return $next($request);
        }

    }
}