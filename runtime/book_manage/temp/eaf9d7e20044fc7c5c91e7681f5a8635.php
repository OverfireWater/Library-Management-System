<?php /*a:1:{s:75:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\update\upPersonalPwd.html";i:1682300116;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <style>
        .contairn {
            margin: 20px;
            margin-right: 100px;
        }
    </style>
</head>
<body>
<div class="contairn">
    <form class="layui-form" action="" id="addForm" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">原密码:</label>
            <div class="layui-input-block">
                <input type="password" name="oldPwd" required lay-verify="required" placeholder="请输入原密码"
                       autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">修改密码:</label>
            <div class="layui-input-block">
                <input type="password" name="newPwd" id="newpwd" required lay-verify="required" placeholder="请修改密码"
                       autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码:</label>
            <div class="layui-input-block">
                <input type="password" name="enterPwd" id="enterpwd" required lay-verify="required" placeholder="请确认密码"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            </div>
        </div>
    </form>
</div>
</body>
<script type="text/javascript" src="/static/RBAC_server/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
<script>
    //Demo
    layui.use('form', function () {
        var form = layui.form,
            $ = layui.jquery;
        //监听提交
        form.on('submit(formDemo)', function (data) {
            // layer.msg(JSON.stringify(data.field));
            var newpwd = $("#newpwd").val();
            var enterpwd = $("#enterpwd").val();
            if (newpwd == enterpwd) {
                var form_data = new FormData($('#addForm')[0]);
                $.ajax({
                    type: "post",
                    url: "admin/up_pwd",
                    data: form_data,
                    dataType: "json",
                    processData: false, // 告诉jQuery不要去处理发送的数据
                    contentType: false, // 告诉jQuery不要去设置Content-Type请求头
                    success: function (result) {
                        if (result.code == 0) {
                            layer.msg(result.msg, {
                                icon: 1,
                                title: "提示"
                            });
                            setTimeout('parent.location.reload()', 500);
                        } else if (result.code == 1) {
                            layer.msg(result.msg, {
                                icon: 0,
                                title: "提示"
                            });
                        } else if (result.code == 2) {
                            layer.msg(result.msg, {
                                icon: 0,
                                title: "提示"
                            });
                        }
                    }
                });
            }else {
                layer.msg("两次密码不一样", {
                    icon: 0,
                    title: "提示"
                });
            }
            return false;
        });
    });
</script>
</html>