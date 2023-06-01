<?php /*a:1:{s:92:"C:\PHP\WWW\kzy\Library-Management-System\app\book_manage\view\update\upPersonalUserInfo.html";i:1685096299;}*/ ?>
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
    <form class="layui-form" action="" id="addForm" method="post" autocapitalize="off">
        <div class="layui-form-item">
            <label class="layui-form-label">用户名:</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="<?php echo htmlentities($userInfo['BerName']); ?>" required lay-verify="required" placeholder="请输入用户名" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份证号:</label>
            <div class="layui-input-block">
                <input type="text" name="cardId" value="<?php echo htmlentities($userInfo['BerCardId']); ?>" required lay-verify="required" placeholder="请输入真实姓名" autocomplete="off"
                       oninput = "value=value.replace(/[^\d]/g,'')" maxlength="18"    class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">

            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
                <input type="text" name="phone" value="<?php echo htmlentities($userInfo['BerPhone']); ?>" maxlength="11" oninput = "value=value.replace(/[^\d]/g,'')" required  lay-verify="required|text" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">当前权限为</label>
            <div class="layui-input-block">
                <input type="text" style="border: none"  value="<?php echo $userInfo['BerRole']==0 ? '管理员' : htmlentities($userInfo['BerRole']==1?'学生':$userInfo['BerRole']==2?'普通老师':$userInfo['BerRole']==3?'管理老师':''); ?>"  readonly autocomplete="off" class="layui-input">
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
            $.ajax({
                type: "post",
                url: "admin/up_personal_userinfo",
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

</script>
</html>