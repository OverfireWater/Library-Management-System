<?php /*a:1:{s:85:"C:\PHP\WWW\kzy\Library-Management-System\app\book_manage\view\update\upBookState.html";i:1684843105;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <!-- Google Chrome Frame也可以让IE用上Chrome的引擎: -->
    <meta name="renderer" content="webkit">
    <!--国产浏览器高速模式-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">

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
            <label class="layui-form-label">图书状态</label>
            <div class="layui-input-block" style="width: 300px">
                <select name="state" id="state" lay-verify="required">
                    <option value="0">仓库</option>
                    <option value="1">上架</option>
                    <option value="3">丢失</option>
                    <option value="4">报废</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" id="file_sub" lay-submit lay-filter="formDemo">修改</button>
            </div>
        </div>
    </form>
</div>
</body>
<script type="text/javascript" src="/static/RBAC_server/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/static/layui/layui.js"></script>
    <script>

        layui.use(['form','layer'], function () {
            var form = layui.form,
                layer=layui.layer;

            //监听提交
            form.on('submit(formDemo)', function (data) {
                // layer.msg(JSON.stringify(data.field));
                var form_data = new FormData($('#addForm')[0]);
                form_data.append("id",<?php echo htmlentities($id); ?>);
                $.ajax({
                    type: "post",
                    url: "upBookState",
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
                            setTimeout('parent.location.reload()', 500);
                        } else if (result.code == 1) {
                            layer.msg(result.msg, {
                                icon: 0,
                                title: "提示"
                            });
                        }
                    }
                });
                return false;
            });

        });
        $(function () {
            $("#state option[value='<?php echo htmlentities($stateId); ?>']").prop("selected","selected");
        });
    </script>
</html>