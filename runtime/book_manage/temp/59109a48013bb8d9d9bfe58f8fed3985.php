<?php /*a:1:{s:89:"D:\phpstudy_pro\WWW\Library-Management-System\app\book_manage\view\user\renew_select.html";i:1685605344;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/static/RBAC_server/img/librarycolor_yello.png" type="image/x-icon">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <style>
        .container_from{
            margin: 20px;
        }
    </style>
</head>
<body>
<div class="container_from">
    <form action="" class="layui-form">
        <div class="layui-inline">
            <label class="layui-form-label" style="width: 100px!important;">选择续借日期</label>
            <div class="layui-input-inline">
                <input type="text" name="date" id="date1" lay-verify="date" placeholder="选择年月日" autocomplete="off"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="margin-top: 20px">
            <div class="layui-input-block">
                <button class="layui-btn" id="file_sub" lay-submit lay-filter="formDemo">提交</button>
            </div>
        </div>
    </form>
</div>
</body>
<script src="/static/layui/layui.js"></script>
<script>
    layui.use(['form','jquery', 'layedit', 'laydate'], function() {
        var form = layui.form
            ,$=layui.$
            , laydate = layui.laydate;

        //日期
        laydate.render({
            elem: '#date1'
            ,min:1
            ,max:15
        });
        form.on('submit(formDemo)', function (data) {
            $.ajax({
                type: "post",
                url: "renew_book",
                data: {"bookNo":<?php echo htmlentities($bookNO); ?>,"bookId":<?php echo htmlentities($bookId); ?>,"datetime":data.field.date},
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
            return false;
        });
    });
</script>
</html>