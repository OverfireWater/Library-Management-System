<?php /*a:1:{s:83:"D:\phpstudy_pro\WWW\Library-Management-System\app\book_manage\view\login\index.html";i:1685603302;}*/ ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title><?php echo htmlentities($webInfo['webname']); ?></title>
    <link href="/static/login/css/default.css" rel="stylesheet" type="text/css" />
    <!--必要样式-->
    <link rel="icon" href="/favicon111.ico" type="image/x-icon">
    <link href="/static/login/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="/static/login/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/static/login/css/loaders.css" rel="stylesheet" type="text/css" />
    <style>
        .register_text{
            margin-top: 30px;
        }
       html, body {
            padding: 0;
            margin: 0;
            height: 100%;
            font-size: 16px;
            background-repeat: no-repeat;
            background-position: left top;
            background-image: url(/static/login/img/bacgroup.jpg);
            background-color: #242645;
            color: #fff;
            font-family: 'Source Sans Pro';
            background-size: 100%;

        }
        input:-webkit-autofill {
            -webkit-text-fill-color: #fff;
            transition: background-color 500000000s ease-in-out 0s;
        }
    </style>

</head>
<body>
<div class='login'>

    <img class="MyLogo" src="/static/RBAC_server/img/librarycolor_yello.png" width="200"  alt="LOGO">
    <div class='login_title'>
        <span></span>
    </div>
    <form type="post" autocomplete="off">
    <div class='login_fields'>
        <div class='login_fields__user'>
            <div class='icon'>
                <img alt="" src='/static/login/img/user_icon_copy.png'>
            </div>
            <input name="login" placeholder='账号或手机号' oninput = "value=value.replace(/[^\d]/g,'')" maxlength="16" class="username" type='text' autocomplete="off" />
            <div class='validation'>
            </div>
        </div>
        <div class='login_fields__password'>
            <div class='icon'>
                <img alt="" src='/static/login/img/lock_icon_copy.png'>
            </div>
            <input name="pwd" class="passwordNumder" placeholder='密码' maxlength="16" type='text' autocomplete="off">
        </div>
        <div class='login_fields__submit'>
            <input type='button' value='登录'>
            <div class="register_text">没有账号？ <a href="register_data" style="color: #208ce8">点击注册</a></div>
        </div>
    </form>
    </div>
    <div class='success'>
    </div>
    <div class='disclaimer'>
        <h4>欢迎来到<?php echo htmlentities($webInfo['webname']); ?></h4>
    </div>
</div>
<div class='authent'>
    <div class="loader" style="height: 60px;width: 60px;margin-left: 28px;margin-top: 40px">
        <div class="loader-inner ball-clip-rotate-multiple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <p>认证中...</p>
</div>
<div class="OverWindows"></div>

<link href="/static/login/layui/css/layui.css" rel="stylesheet" type="text/css" />

<script src="/static/login/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/static/login/js/jquery-ui.min.js"></script>
<script type="text/javascript" src='/static/login/js/stopExecutionOnTimeout.js?t=1'></script>
<script src="/static/login/layui/layui.js" type="text/javascript"></script>
<script src="/static/login/js/Particleground.js" type="text/javascript"></script>
<script src="/static/login/js/jquery.mockjax.js" type="text/javascript"></script>
<script>
    //默认账号密码
    $(document).keypress(function (e) {
        // 回车键事件
        if (e.which == 13) {
            $('input[type="button"]').click();
        }
    });
    //粒子背景特效
    $('body').particleground({
        dotColor: '#546a99',
        lineColor: '#6c91ef'
    });
    $('input[name="pwd"]').focus(function () {
        $(this).attr('type', 'password');
    });
    $('input[type="text"]').focus(function () {
        $(this).prev().animate({'opacity': '1'}, 200);
    });
    $('input[type="text"],input[type="password"]').blur(function () {
        $(this).prev().animate({'opacity': '.5'}, 200);
    });
    $('input[name="login"],input[name="pwd"]').keyup(function () {
        var Len = $(this).val().length;
        if (!$(this).val() == '' && Len >= 5) {
            $(this).next().animate({
                'opacity': '1',
                'right': '30'
            }, 200);
        } else {
            $(this).next().animate({
                'opacity': '0',
                'right': '20'
            }, 200);
        }
    });
    layui.use('layer', function () {
        //非空验证
        $('input[type="button"]').click(function () {
            var login = $('.username').val();
            var pwd = $('.passwordNumder').val();
            if (login == '') {
                ErroAlert('请输入您的账号');
                return false;
            } else if (pwd == '') {

                ErroAlert('请输入密码');
                return false;
            }else {
                //认证中..
                $('.login').addClass('test'); //倾斜特效
                setTimeout(function () {
                    $('.login').addClass('testtwo'); //平移特效
                }, 300);
                setTimeout(function () {
                    $('.authent').show().animate({right: -320}, {
                        easing: 'easeOutQuint',
                        duration: 600,
                        queue: false
                    });
                    $('.authent').animate({opacity: 1}, {
                        duration: 200,
                        queue: false
                    }).addClass('visible');
                }, 500);

                //登陆
                var JsonData = {name: login, pwd: pwd};
                //此处做为ajax内部判断
                $.ajax({
                    type: "post",
                    url: "islogin",
                    data: JsonData,
                    dataType: 'json',
                    success: function (result) {
                        //认证完成
                        setTimeout(function () {
                            $('.authent').show().animate({ right: 90 }, {
                                easing: 'easeOutQuint',
                                duration: 600,
                                queue: false
                            });
                            $('.authent').animate({ opacity: 0 }, {
                                duration: 200,
                                queue: false
                            }).addClass('visible');
                            $('.login').removeClass('testtwo'); //平移特效
                        }, 2000);
                        setTimeout(function () {
                            $('.authent').hide();
                            $('.login').removeClass('test');
                            if (result.code ==1) {
                                //登录成功
                                $('.login div').fadeOut(100);
                                $('.success').fadeIn(1000);
                                $('.success').html(result.msg);
                                if (result.role==0 || result.role==3){
                                    setTimeout("window.location.replace('index_show')",1000);
                                    // //跳转操作
                                }else if (result.role==1 || result.role==2){
                                    setTimeout("window.location.replace('userView')",1000);
                                }

                            } else {
                                ErroAlert(result.msg);
                            }
                        }, 2400);
                    },
                    error: function () {
                        layer.msg("服务器错误！");
                    }
                });
            }
            return false;
        })
    })
    function ErroAlert(e) {
        var index = layer.alert(e, {
            icon: 5,
            time: 2000,
            offset: 't',
            closeBtn: 0,
            title: '错误信息',
            btn: [],
            anim: 2,
            shade: 0
        });
        layer.style(index, {
            color: '#777'
        });
    }

</script>
</body>
</html>
