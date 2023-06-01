<?php /*a:1:{s:81:"C:\PHP\WWW\kzy\Library-Management-System\app\book_manage\view\login\register.html";i:1685096562;}*/ ?>
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
    <link rel="icon" href="/favicon111.ico" type="image/x-icon">
    <link href="/static/login/css/default.css" rel="stylesheet" type="text/css" />
    <!--必要样式-->
    <link href="/static/login/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="/static/login/css/demo.css" rel="stylesheet" type="text/css" />
    <link href="/static/login/css/loaders.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/static/layui/css/layui.css">

    <style>
        .register_text{
            margin-top: 20px;
            margin-left: 125px;
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
    </style>
</head>
<body>
<div class='login'>
    <form action="" method="post" id="formdata" autocomplete="off">
    <img class="MyLogo" src="/static/RBAC_server/img/librarycolor_yello.png" width="150"  alt="LOGO">
    <div class='login_fields'>
        <div class='login_fields__user'>
            <div class='icon'>
                <i class="layui-icon layui-icon-list"></i>
            </div>
            <input name="phone" placeholder="手机号"
                   oninput = "value=value.replace(/[^\d]/g,'')"  id="phone" maxlength="11" class="username" type='text' autocomplete="off" />
            <div class='validation'>
                <img alt="" src='/static/login/img/tick.png'>
            </div>
        </div>
        <div class='login_fields__password'>
            <div class='icon'>
                <img alt="" src='/static/login/img/lock_icon_copy.png'>
            </div>
            <input name="pwd" class="passwordNumder" placeholder='登陆密码（大于六位数）' id="pwd" maxlength="16" type='password' autocomplete="off">
        </div>
        <div class='login_fields__user'>
            <div class='icon'>
                <i class="layui-icon layui-icon-user"></i>
            </div>
            <input name="name" placeholder='用户昵称' maxlength="16" id="name" class="username" type='text' autocomplete="pwd" />
            <div class='validation'>
                <img alt="" src='/static/login/img/tick.png'>
            </div>
        </div>
        <div class='login_fields__user'>
            <div class='icon'>
                <i class="layui-icon layui-icon-auz"></i>
            </div>
            <input name="card" placeholder='身份证号' minlength="18" id="card" maxlength="18" class="username" type='text'
                   oninput = "value=value.replace(/[^\d]/g,'')" autocomplete="off" />
            <div class='validation'>
                <img alt="" src='/static/login/img/tick.png'>
            </div>
        </div>

        <div class='login_fields__submit'>
            <input type='button' value='注册'>
            <div class="register_text">已有账号？ <a href="login" style="color: #208ce8">点击登陆</a></div>
        </div>
    </div>
    <div class='success'>
    </div>
    <div class='disclaimer'>
        <h4>欢迎注册<?php echo htmlentities($webInfo['webname']); ?>借阅账号</h4>
    </div>
    </form>
</div>
<div class='authent'>
    <div class="loader" style="height: 60px;width: 60px;margin-left: 28px;margin-top: 40px">
        <div class="loader-inner ball-clip-rotate-multiple">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <p>正在注册中...</p>
</div>
<div class="OverWindows"></div>

<link href="/static/login/layui/css/layui.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="/favicon111.ico" type="image/x-icon">
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
            var pwd = $('#pwd').val();
            var name = $('#name').val();
            var card = $('#card').val();
            var phone = $('#phone').val();

            if (pwd == '' || pwd.length<6) {

                ErroAlert('请输入密码大于六位数');
                return false;
            }else if (name == '') {

                ErroAlert('请输入用户名');
                return false;
            }else if (card == '' || card.length<18 || card.length>18) {

                ErroAlert('身份证输入错误');
                return false;
            }else if (phone == '' ||phone.length<11 ||phone.length>11) {

                ErroAlert('电话号码输入错误');
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
                var JsonData =new FormData($("#formdata")[0]);
                //此处做为ajax内部判断
                $.ajax({
                    type: "post",
                    url: "isregister",
                    data: JsonData,
                    dataType: 'json',
                    processData: false, // 告诉jQuery不要去处理发送的数据
                    contentType: false, // 告诉jQuery不要去设置Content-Type请求头
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
                                setTimeout("window.location.replace('login')",1000);
                                // //跳转操作
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
