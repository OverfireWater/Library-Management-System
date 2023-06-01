<?php /*a:1:{s:53:"D:\phpstudy_pro\WWW\thinkPHP\view\index\case_add.html";i:1680008761;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
</head>
<body>
<form class="layui-form" action="" id="formdata" style="width: 600px!important;margin-top: 20px">
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-block">
            <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label">类型名称</label>
        <div class="layui-input-block layui_width">
            <select name="type" lay-verify="" lay-search >
                <option value="101" selected>layer</option>
                <option value="021">form</option>
                <option value="0571" >layim</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">关键字</label>
        <div class="layui-input-block">
            <input type="text" name="keywords" required  lay-verify="required" placeholder="请输入关键字" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">简介</label>
        <div class="layui-input-block">
            <textarea name="desc" placeholder="请输入简介" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
<script src="/static/layui/layui.js"></script>
<script src="/static/js/jquery-3.js"></script>
<script>
    layui.use(['form','jquery'], function(){
      var form = layui.form,
        layer=layui.layer;
      //监听提交
      form.on('submit(formDemo)', function(){
        var formdata=$("#formdata")[0];
        formdata=new FormData(formdata);
        $.ajax({
            type:'post',
            url:'addData',
            data:formdata,
            dataType:'json',
            processData:false,
            contentType:false,
            success:function (res){
                if (res.code == 1) {
                        layer.msg(res.msg, {icon: 1});
                        setTimeout('window.location.reload()', 500);
                    } else {
                        layer.msg(res.msg, {icon: 0});
                    }
            },
            error:function (){
                layer.msg('服务器连接失败');
            }
        });
        return false;
      });
    });
</script>
</html>