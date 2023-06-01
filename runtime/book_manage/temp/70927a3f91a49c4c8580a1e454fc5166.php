<?php /*a:1:{s:79:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\admin\upPersonalUserInfo.html";i:1681794284;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <style>
        .contairn{
            margin: 20px;
            margin-right: 100px;
        }
    </style>
</head>
<body>
<div class="contairn">
    <form class="layui-form" action="" id="addForm" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名:</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="<?php echo htmlentities($userInfo['userName']); ?>" required lay-verify="required" placeholder="请输入用户名" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">真实姓名:</label>
            <div class="layui-input-block">
                <input type="text" name="redlName" value="<?php echo htmlentities($userInfo['redlName']); ?>" required lay-verify="required" placeholder="请输入真实姓名" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别:</label>
            <div class="layui-input-block">
                <input type="radio" name="sex" value="男" title="男" checked>
                <input type="radio" name="sex" value="女" title="女">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="email" name="email" value="<?php echo htmlentities($userInfo['email']); ?>" required  lay-verify="required|email" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
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
            var form_data = new FormData($('#addForm')[0]);
            form_data.append("id",<?php echo htmlentities($userInfo['id']); ?>);
            $.ajax({
                type: "post",
                url: "up_personal_userinfo",
                data: form_data,
                dataType: "json",
                processData: false, // 告诉jQuery不要去处理发送的数据
                contentType: false, // 告诉jQuery不要去设置Content-Type请求头
                success: function(result) {
                    console.log(result);
                    if (result.code==0) {
                        layer.msg(result.msg,{
                            icon:1,
                            title:"提示"
                        });
                        setTimeout('parent.location.reload()',500);
                    }else if (result.code==1) {
                        layer.msg(result.msg,{
                            icon:0,
                            title:"提示"
                        });
                    }else if (result.code==2) {
                        layer.msg(result.msg,{
                            icon:0,
                            title:"提示"
                        });
                    }
                }
            });
            return false;
        });
    });
    $(function() {
        var radio = document.getElementsByName("sex");
        var sex="<?php echo htmlentities($userInfo['sex']); ?>";
        if (sex=="男"){
            radio[0].checked=true;
        }else {
            radio[1].checked=true;
        }
    });
</script>
</html>