<?php /*a:1:{s:73:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\admin\bookLossInfo.html";i:1682581116;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <!-- Google Chrome Frame也可以让IE用上Chrome的引擎: -->
    <meta name="renderer" content="webkit">
    <!--国产浏览器高速模式-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="icon" href="/static/RBAC_server/img/librarycolor_yello.png" type="image/x-icon">
    <script type="text/javascript" src="/static/RBAC_server/js/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/static/layui/css/layui.css">
    <script type="text/javascript" src="/static/layui/layui.js"></script>
    <!-- 公共样式 结束 -->
    <style>
        a {
            color: #fff;
        }

        a:hover {
            color: #fff;
        }

        .cBody {
            margin: 20px;
        }

        body {
            zoom: 0.9;
        }
    </style>
</head>
<body>

<div class="cBody">
    <div class="console">
        <div class="demoTable">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <input type="text" name="keywords" id="keywords" required lay-verify="required"
                           placeholder="输入借阅信息" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" id="form_btn" data-type="reload">搜索</button>
            </div>
        </div>
    </div>

    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>
</body>
<script type="text/html" id="state">
    {{# if(d.isborrow==1) { }}
    <span style="color: #55d05b">已归还</span>
    {{# } else if(d.isborrow==0){ }}
    <span style="color: #e04b4b">未归还</span>
    {{# } }}
</script>
<script type="text/html" id="switchTpl">
    <input type="checkbox" id="{{d.RLRId}}" name="isOld" value="{{d.BNo}}" lay-skin="switch" lay-text="是|否"
           lay-filter="sexDemo" {{ d.isloss== 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table', 'layer', 'form'], function () {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        table.render({
            elem: '#test'
            , url: 'admin/get_book_loss_data'
            , title: '用户数据表'
            , cellMinWidth: 100
            , cols: [[
                {field: 'RLRId', title: '序号', fixed: 'left', width: 80, unresize: false, sort: true,align:"center"}
                , {field: 'BNo', title: '图书编号',align:"center"}
                , {field: 'BLRTime', title: '挂失时间',align:"center"}
                , {field: 'isloss', title: '是否找到',align:"center",templet:"#switchTpl"}
                , {fixed: 'right', title: '操作', width: 150, toolbar: '#barDemo',align:"center"}
            ]]
            , page: true
            , height: 'full-30'
            , id: "testreload"
        });
        //表格重载
        var active = {
            reload: function () {
                var keywords = $('#keywords');

                //执行重载
                table.reload('testreload', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    , where: {
                        keywords: keywords.val()
                    }
                });
            }
        };

        $('.demoTable #form_btn').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        //监听开关操作
        form.on('switch(sexDemo)', function (obj) {
            const name = this.name;
            const checked_sta = obj.elem.checked;
            const BNo = this.value;
            $.ajax({
                type: "post",
                url: "admin/upSwich_bookloss",
                data: {"BNo": BNo, "flag": checked_sta},
                dataType: "json",
                success: function (result) {
                    if (result.code == 0) {
                        layer.msg(result.msg);
                    } else if (result.code == 1) {
                        layer.msg(result.msg);
                    }
                },
                error: function () {
                    layer.msg("数据错误");
                }
            });
        });
        //监听行工具事件
        table.on('tool(test)', function (obj) {
            var data = obj.data;
            // console.log(data.ptid);
            if (obj.event === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    $.ajax({
                        type: "post",
                        url: "admin/de_bookloss",
                        data: {"id": data.RLRId},
                        dataType: "json",
                        success: function (result) {
                            if (result.code == 0) {
                                layer.msg(result.msg);
                                obj.del();
                                
                            } else if (result.code == 1) {
                                layer.msg(result.msg);
                            }
                        },
                        error: function () {
                            layer.msg("数据错误");
                        }
                    });
                    layer.close(index);
                });
            }
        });
    });
</script>
</html>