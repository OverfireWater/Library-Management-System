<?php /*a:1:{s:89:"D:\phpstudy_pro\WWW\Library-Management-System\app\book_manage\view\update\upBookInfo.html";i:1684754326;}*/ ?>
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
            margin-right: 15%;
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
            <label class="layui-form-label">ISBN标准</label>
            <div class="layui-input-block">
                <input type="text" name="isbn" required lay-verify="required|ZHCheck" value="<?php echo htmlentities($bookinfo['Bisbn']); ?>" placeholder="请输入ISBN标准书号"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图书名称</label>
            <div class="layui-input-block">
                <input type="text" name="title" required lay-verify="required|ZHCheck" value="<?php echo htmlentities($bookinfo['BName']); ?>" placeholder="请输入图书名称"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图书类型</label>
            <div class="layui-input-block" style="width: 300px">
                <select name="bookType" id="bookType" lay-verify="required" lay-search>
                    <?php foreach($booktypeinfo as $val): ?>
                    <option value="<?php echo htmlentities($val['id']); ?>"><?php echo htmlentities($val['BTName']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">出版社信息:</label>
            <div class="layui-input-block" style="width: 300px">
                <select name="press" id="press" lay-verify="required" lay-search>
                    <?php foreach($pressinfo as $val): ?>
                    <option value="<?php echo htmlentities($val['PressId']); ?>"><?php echo htmlentities($val['PressName']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">作者</label>
            <div class="layui-input-block ">
                <input type="text" name="author" required lay-verify="required|ZHCheck" value="<?php echo htmlentities($bookinfo['BAuthor']); ?>" placeholder="请键入图书作者"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">定价</label>
            <div class="layui-input-block ">
                <input type="number" name="price" required lay-verify="required|ZHCheck" value="<?php echo htmlentities($bookinfo['BPrice']); ?>" placeholder="请键入图书定价"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">新书 | 旧书</label>
            <div class="layui-input-block">
                <input type="radio"  lay-filter="isNew" name="isNew" value="0" title="新书">
                <input type="radio"  lay-filter="isNew" name="isNew" value="1" title="旧书">
            </div>
        </div>
        <div class="layui-form-item" id="account" style="display: none">
            <label class="layui-form-label" style="color: #e31660">捐赠人</label>
            <div class="layui-input-block ">
                <input type="text" name="account" required lay-verify="required|ZHCheck" value="<?php echo htmlentities($bookOldAccount); ?>" placeholder="请键入图书捐献人"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">图书封面</label>
            <div class="layui-input-inline shortInput">
                <div class="file_img">
                    <img src="<?php echo htmlentities($bookinfo['BUrl']); ?>" id="choose_img" alt="" width="100" height="100">
                    <button type="button" class="layui-btn" style="margin-top: 5px;" id="file_choose_but">请选择图片</button>
                </div>
                <input type="file" name="file" id="file" class="file" accept="image/png" onchange="choose_file_block()">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">简介</label>
            <div class="layui-input-block ">
                <textarea name="remark" placeholder="请输入内容" id="text" class="layui-textarea" style="height: 200px"><?php echo htmlentities($bookinfo['SRemark']); ?></textarea>
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
            $("#bookType option[value='<?php echo htmlentities($bookinfo['BTId']); ?>']").prop("selected","selected");
            $("#press option[value='<?php echo htmlentities($bookinfo['BPressId']); ?>']").prop("selected","selected");
            var isNew = document.getElementsByName("isNew");
            if (<?php echo htmlentities($isOld); ?>==1){
                $("#account").attr("style","display:block");
                isNew[1].checked=true;
            }else {
                $("#account").attr("style","display:none");
                isNew[0].checked=true;
            }
        });
        layui.use(['form','layedit'], function () {
            var form = layui.form
                ,layedit=layui.layedit;
            var index=layedit.build("text",{
                tool: [
                    'strong' //加粗
                    ,'italic' //斜体
                    ,'underline' //下划线
                    ,'del' //删除线
                    ,'|' //分割线
                    ,'left' //左对齐
                    ,'center' //居中对齐
                    ,'right' //右对齐
                ]
            })
            //监听提交
            form.on('submit(formDemo)', function (data) {
                // layer.msg(JSON.stringify(data.field));
                layedit.sync(index)
                var form_data = new FormData($('#addForm')[0]);
                form_data.append("id",<?php echo htmlentities($id); ?>);
                $.ajax({
                    type: "post",
                    url: "upBookInfo",
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
                        } else if (result.code == 2) {
                            layer.msg(result.msg, {
                                icon: 0,
                                title: "提示"
                            });
                        } else {
                            layer.msg(result.msg, {
                                icon: 0,
                                title: "提示"
                            });
                        }

                    }
                });
                return false;
            });
            form.on('radio(isNew)', function (data) {

                if( data.value=="1"){　　　　　　//判断当前多选框是选中还是取消选中
                    $("#account").attr("style","display:block");
                }else{
                    $("#account").attr("style","display:none");
                }
                var value = data.value;   //  当前选中的value值
            });
        });
    </script>
    <script>
        layui.use('layer', function () {
            var layer = layui.layer;
        })

        function choose_file_block() {
            if ($('#file').val()) {
                var files = document.getElementById('file').files[0];
                var url = window.URL.createObjectURL(files);
                $('#choose_img').attr('src', url).removeClass("dis-none");
            } else {
                $('#choose_img').attr('src', "").addClass('dis-none');
            }
        }

        $('#file_choose_but').click(function () {
            $('#file').trigger('click');
        });
    </script>

</div>
</body>

</html>