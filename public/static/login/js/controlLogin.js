//默认账号密码
$(document).keypress(function (e) {
    // 回车键事件
    if (e.which == 13) {
        $('input[type="button"]').click();
    }
});
//粒子背景特效
$('body').particleground({
    dotColor: '#E8DFE8',
    lineColor: '#1b3273'
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
                url: "admin/login",
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
                                setTimeout("window.location.replace('../page/index.php')",1000);
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
