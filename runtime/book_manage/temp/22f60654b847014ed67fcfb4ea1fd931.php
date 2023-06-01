<?php /*a:1:{s:79:"C:\PHP\WWW\kzy\Library-Management-System\app\book_manage\view\user\details.html";i:1684975680;}*/ ?>
﻿<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo htmlentities($webInfo['webname']); ?></title>
    <link rel="icon" href="/favicon111.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/static/book_manage/output.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/book_manage/comment/comment.css">
</head>

<body class="bg-grey-lighter font-sans antialiased">
<div class="fixed bg-grey-lighter pin z-50 flex justify-center items-center" id="loading">
    <svg width="60px" height="60px" viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink" id="morphing">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-1178.000000, -87.000000)">
                <g transform="translate(1159.000000, 0.000000)">
                    <g transform="translate(0.000000, 87.000000)">
                        <g transform="translate(19.000000, 0.000000)">
                            <circle id="small-circle" fill="#5661B3" cx="30" cy="30" r="30"></circle>
                            <path id="moon"
                                  d="M30.5,49.7304688 C40.7172679,49.7304688 30.5,43.266096 30.5,33.0488281 C30.5,22.8315603 40.7172679,12 30.5,12 C20.2827321,12 11.0390625,20.6479665 11.0390625,30.8652344 C11.0390625,41.0825022 20.2827321,49.7304688 30.5,49.7304688 Z"
                                  fill="#F4E1E0"></path>
                            <circle id="big-circle" fill="#070707" cx="31" cy="31" r="11"></circle>
                        </g>
                    </g>
                </g>
            </g>
        </g>
    </svg>
</div>
<div class="bg-indigo-darker text-center p-4 px-6 flex items-center" style="background-color: #5349ae">
    <div class="hidden lg:block lg:w-1/4 xl:w-1/5 pr-8">
        <a href="" class="flex justify-start pl-6">
            <img src="/static/RBAC_server/img/librarycolor_yello.png" style="width:120px;height: 40px!important;" class="" alt="logo">
        </a>
    </div>
    <div class="lg:hidden pr-3" id="mobile-nav-trigger">
        <div class="toggle p-2 block"><span></span></div>
    </div>
    <div class="flex flex-grow items-center lg:w-3/4 xl:w-4/5 coniant">
        <form action="userView" method="get" id="search_form">
			<span class="relative w-full" style="width: 300px;">
				<input type="search" placeholder="搜索" name="keywords" value="" autocomplete="off"
                       class="w-full text-sm text-white transition border border-transparent focus:outline-none focus:border-indigo placeholder-white rounded bg-indigo-medium py-1 px-2 pl-10 appearance-none leading-normal ds-input">
				<div class="absolute search-icon" style="top: .2rem; left: .8rem;">
					<svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
						<path
                                d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
						</path>
					</svg>
				</div>
			</span>

        </form>
        <input type="button" id="search_button" value="搜索" class="input_search text-sm">
        <div
                class="login_exit text-sm text-right text-white py-2 px-3  no-underline hidden lg:block lg:w-1/3 px-6">
            <a class="text-sm text-white hover:text-grey-dark" href="#">退出登陆</a></div>
    </div>
</div>
<!-- Main -->
<div class="flex">
    <!-- Side Nav -->

    <!-- Content -->
    <div class="flex flex-1 flex-col md:px-6 pt-10 " style="margin: 0 6rem" id="content">

        <h4 class="hidden md:inline-block text-grey-dark font-normal"><a href="userView">首页</a> > 图书详情</h4>
        <div class="border_line"></div>
        <!-- Library -->
        <div class="hidden px-2 pt-2 md:px-0 flex-wrap order-2 pb-8 js-tab-pane active" id="section-library">
            <div class="flex flex-row sm:flex-col items-center sm:items-start w-full xs:w-1/2 sm:w-1/3 md:w-1/5 p-4 js-book">
                <img src="<?php echo htmlentities($bookInfo['BUrl']); ?>" alt="book-01" style="min-height: 180px;min-width: 141px;max-height: 230px;max-width: 250px;"
                     class="w-1/3 sm:w-full shadow-md transition-normal hover:brighter hover:translate-y-1 hover:shadow-lg hover:border-indigo">
            </div>
            <div class="border_line"></div>
            <div class="book_text_margin p-4 ">
                <h2 class="font-normal"><?php echo htmlentities($bookInfo['BName']); ?></h2>
                <br>
                <span>类型：<?php echo htmlentities($bookInfo['BTName']); ?></span>
                <br>
                <div class="author_box"><span>作者：<?php echo htmlentities($bookInfo['BAuthor']); ?></span></div>
                <br>
                <span>图书简介</span>
                <br>
                <div class="book_remark">
                   <?php echo $bookInfo['SRemark']; ?>
                </div>
                <div class="border_line"></div>
                <?php if(($state==0&&$borrow==0)): ?><div class="state_book color-error">此书尚未上架</div>
                <?php elseif(($state==2&&$borrow==0)): ?> <div class="state_book color-bule">此书正在外借中</div>
                <?php elseif(($state==3&&$borrow==0)): ?><div class="state_book color-orange ">此书已丢失</div>
                <?php elseif(($state==4&&$borrow==0)): ?><div class="state_book color-red">此书已报废</div>
                <?php elseif(($state==1&&$borrow==0)): ?><div class="layui-btn layui-btn-radius layui-btn-normal jie_btn" id="Borrow">借阅</div>
                <?php elseif(($state==2&&$borrow==1)): ?>
                <div>
                    <br/>
                    <div>归还日期为: <p style="color: rebeccapurple"><?php echo htmlentities($book_borrower_cord['BerEndTime']); ?></p></div>
                    <div class="layui-btn layui-btn-radius layui-btn-normal jie_btn" style="margin-left: 10px" id="Return">还书</div>
                    <div class="layui-btn layui-btn-radius layui-btn-warm jie_btn" id="renew">续借</div>
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
<!--评论-->
<div class="wrap">
    <div class="wrap-head">
        <div class="head-logo">
            <p>发表评论</p>
        </div>
        <div class="head-txt">
            <a class="title-txt" href="javascript:void(0)"></a>
        </div>
    </div>
    <div class="main-txt">
        <textarea name="" rows="" cols="" class="main-area"></textarea>
    </div>
    <div class="warp-footer">
        <div class="warp-footer-btns">
            <div class="release-btn">
                <a href="javascript:void(0)">发布</a>
            </div>
        </div>
    </div>
</div>
<!-- 显示留言的主体 -->
<div class="show">
    <?php if((is_array($review))): foreach($review as $val): ?>
    <div class="show-content">
        <div class="show-name"><?php echo htmlentities($val['borrower']['BerName']); ?></div>
        <div class="show-txt">
            <p class=""><?php echo htmlentities($val['RContent']); ?></p>
        </div>
        <div class="show-time"><?php echo htmlentities($val['RDateTime']); ?></div>
    </div>
    <?php endforeach; else: ?> <span id="isReview"><?php echo htmlentities($review); ?> 快点发表评论吧</span>
    <?php endif; ?>
</div>
<script src="/static/book_manage/bundle.js" async defer></script>
<script type="text/javascript" src="/static/RBAC_server/js/jquery-1.11.3.min.js"></script>
<script src="/static/layui/layui.js"></script>
<script>
    $(function (){
        $("#search_button").click(function (){
            $("#search_form").submit();
        });
    });
    layui.use(['layer','jquery'], function(){
        var layer = layui.layer
        ,$=layui.$;
        $("#Borrow").click(function (){
            layer.open({
                type: 2,
                title: "选择归还日期",
                content: "user/open_date_select?bookId=<?php echo htmlentities($bookInfo['id']); ?>&&bookNO=<?php echo htmlentities($bookInfo['BNo']); ?>",
                area: ['600px', '450px'],
                id: "500",
            });
        });
        $("#renew").click(function (){
            layer.open({
                type: 2,
                title: "续借图书日期",
                content: "user/open_date_renew_select?bookId=<?php echo htmlentities($bookInfo['id']); ?>&&bookNO=<?php echo htmlentities($bookInfo['BNo']); ?>",
                area: ['600px', '450px'],
                id: "600",
            });
        });
        $("#Return").click(function (){

            $.ajax({
                type: "post",
                url: "user/return_book",
                data: {"bookNo":<?php echo htmlentities($bookInfo['BNo']); ?>,"borrow":1},
                dataType: "json",
                success:function (res){
                    if (res.code==0){
                        layer.msg(res.msg);
                        setTimeout('parent.location.replace("/index.php/book_manage/userView")', 500);
                    }else {
                        layer.msg(res.msg);
                    }
                },
                error:function (){

                }
            });
        });
    });

</script>
<script>
    // 匿名函数包裹，防止外界操作的修改
    $(function () {
        // 还能输入的字得个数
        var able_count = 200;
        // 是否可以发布留言
        var release_able = false;
        // 右上角文字
        var $title_txt = $('.title-txt');
        // 留言框
        var $main_area = $('.main-area');
        // 发布按钮
        var $release_btn = $('.release-btn');
        // 输入框获取焦点
        $main_area.focus(function () {
            $(this).parent().addClass('outline');
            $title_txt.addClass('title');
            if (able_count >= 0) {
                $title_txt.html("还可以输入" + able_count + "个字");
            } else {
                $title_txt.html("你以超出" + (-able_count) + "个字");
            }
        })

        // 输入框失去焦点
        $main_area.blur(function () {
            $(this).parent().removeClass('outline');
            $title_txt.removeClass('title');
        })

        // 输入框文本修改
        $main_area.on('input', function () {
            // 剩余可输入的字个数
            able_count = 200 - $main_area.val().length;
            // console.log(able_count);
            // 根据可输入字的个数决定右上角文本的提示 与 是否能发布的状态
            if (able_count >= 0 && able_count <= 200) {
                $title_txt.html("还可以输入" + able_count + "个字");
                if (able_count != 200) {
                    release_able = true;
                } else {
                    release_able = false;
                }
            } else {
                $title_txt.html("你以超出" + (-able_count) + "个字");
                release_able = false;
            }
            // 根据发布状态决定发布按钮的样式
            if (release_able) {
                $release_btn.css({
                    backgroundColor: "orange",
                    borderColor: "orange"
                })
            } else {
                $release_btn.css({
                    backgroundColor: "#ffc09f",
                    borderColor: "#ffc09f"
                })
            }

        })

        // 发布事件
        $release_btn.click(function () {
            if (release_able) {
                $.ajax({
                    type:"post"
                    ,url:"user/re_view_info"
                    ,data:{"text":$main_area.val(),"BNo":<?php echo htmlentities($bookInfo['BNo']); ?>}
                    ,dataType:"json"
                    ,success:function (res){
                        if (res.code==0){
                            // 创建show对象的各个部位
                            var $showContent = $('<div class="show-content"></div>'),
                                $showName = $('<div class="show-name"></div>'),
                                $showTxt = $('<div class="show-txt"></div>'),
                                $showTime = $('<div class="show-time"></div>'),
                                $showClose = $('<div class="show-close"></div>'),
                                $showP = $('<p class=""></p>');

                            var date = new Date();
                            // 设置，对象结构内内容
                            $showName.text("<?php echo htmlentities($bername); ?>");
                            $showP.text($main_area.val());
                            $showTime.text(date);
                            // 添加进入主结构
                            $showTxt.append($showP);
                            $showContent.append($showName);
                            $showContent.append($showTxt);
                            $showContent.append($showTime);
                            $showContent.append($showClose);

                            // 向所有匹配元素内部的开始处插入内容
                            $('.show').prepend($showContent);

                            // 添加动画
                            // 位置从输入框处下移
                            $showContent.css({
                                top: '-150px'
                            })
                            $showContent.animate({
                                top: 0
                            }, 200)

                            // 删除事件
                            $showClose.click(function () {
                                // 使用删除动画，创建效果
                                $showContent.animate({
                                    height: 0
                                }, 200, function () {
                                    // 动画结束后将自身从dom中移除
                                    $showContent.remove();
                                })


                            })

                            // 发布成功后收尾工作
                            $("#isReview").remove();
                            $main_area.val(""); //输入框清空
                            able_count = 200;  //输入框可输入内容数重置
                            release_able = false;
                            $release_btn.css({
                                backgroundColor: '#ffc09f',
                                borderColor: '#ffc09f'
                            })  //按钮点击事件重置
                        }else {
                            layer.msg("评论发表失败");
                        }
                    }
                });
            }
        })
    })

</script>
</body>

</html>