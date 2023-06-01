<?php /*a:1:{s:87:"D:\phpstudy_pro\WWW\Library-Management-System\app\book_manage\view\add\addBookType.html";i:1682151576;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <!-- Google Chrome Frame也可以让IE用上Chrome的引擎: -->
    <meta name="renderer" content="webkit">
    <!--国产浏览器高速模式-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="/static/RBAC_server/js/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <!-- 公共样式 结束 -->
    <style>
        .layui-form {
            margin-right: 30%;
        }

        .file {
            display: none;
        }

        .dis-none {
            display: none;
        }

        .layui_width {
            width: 240px;
        }

        .cBody {
            margin: 20px;
        }
    </style>

</head>
<body>
<div class="cBody">
    <form id="addForm" class="layui-form" method="post" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">图书类型</label>
            <div class="layui-input-block">
                <input type="text" name="type" required lay-verify="required|ZHCheck" value="" placeholder="请输入图书类型"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block ">
                <textarea name="remark" placeholder="请输入内容" class="layui-textarea" style="height: 200px"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="file_sub" lay-submit lay-filter="formDemo">立即提交</button>
            </div>
        </div>
    </form>
    <script>
        $(function () {
            $("#products option:first").prop("selected", 'selected');
        });
        layui.use('form', function () {
            var form = layui.form;

            //监听提交
            form.on('submit(formDemo)', function (data) {
                // layer.msg(JSON.stringify(data.field));
                var form_data = new FormData($('#addForm')[0]);
                $.ajax({
                    type: "post",
                    url: "admin/addBookType",
                    data: form_data,
                    dataType: "json",
                    processData: false, // 告诉jQuery不要去处理发送的数据
                    contentType: false, // 告诉jQuery不要去设置Content-Type请求头
                    success: function (result) {
                        console.log(result);
                        if (result.code == 0) {
                            layer.msg(result.msg, {
                                icon: 1,
                                title: "提示"
                            });
                            setTimeout('window.location.reload()', 500);
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

                    },error(res){
                        if (res.status==500){
                            layer.msg(res.responseJSON.message, {
                                icon: 0,
                                title: "提示"
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>
    <script>
        layui.use('layer', function () {
            var layer = layui.layer;
        })
    </script>

</div>
</body>

</html>