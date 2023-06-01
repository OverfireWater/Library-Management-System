<?php /*a:1:{s:73:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\admin\borrowerInfo.html";i:1682581137;}*/ ?>
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
                           placeholder="输入借阅人信息" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" id="form_btn" data-type="reload">搜索</button>
                <button class="layui-btn layui-btn-normal" type="button" lay-filter="formDemo" onclick="open_layer()">
                    借阅人添加
                </button>
            </div>
        </div>
    </div>

    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>
</body>
<script type="text/html" id="switchTpl">
    <input type="checkbox" id="{{d.id}}" name="isOld" value="{{d.id}}" lay-skin="switch" lay-text="新书|旧书"
           lay-filter="sexDemo" {{ d.BIsOld== 0 ? 'checked' : '' }}>
</script>

<script type="text/html" id="state">
    {{# if(d.BerRole==1) { }}
    <span style="color: #55d05b">学生</span>
    {{# } else if(d.BerRole==0){ }}
    <span>管理员</span>
    {{# } else if(d.BerRole==2) { }}
    <span style="color: #0a6999">普通老师</span>
    {{# } else if(d.BerRole==3) { }}
    <span style="color: red">管理老师</span>
    {{# } }}
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table', 'layer', 'form'], function () {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        table.render({
            elem: '#test'
            , url: 'admin/get_borrower_data'
            , title: '用户数据表'
            , cellMinWidth: 100
            , cols: [[
                {field: 'id', title: '序号', fixed: 'left', width: 80, unresize: false, sort: true,align:"center"}
                , {field: 'BerAccount', title: '账号',align:"center"}
                , {field: 'BerName', title: '用户姓名', width: 140 ,align:"center"}
                , {field: 'BerCardId', title: '身份证号', width: 140,align:"center"}
                , {field: 'BerPhone', title: '手机号',align:"center"}
                , {field: 'BerRole', title: '角色类型',align:"center",templet: "#state"}
                , {fixed: 'right', title: '操作', width: 190, toolbar: '#barDemo',align:"center"}
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
            const id = this.value;
            $.ajax({
                type: "post",
                url: "admin/upSwichStatu",
                data: {"id": id, "flag": checked_sta},
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
            if (obj.event === 'seePic') {
                layer.open({
                    type: 1
                    , title: ""
                    , content: '<img src="' + data.BUrl + '" alt="" height="500px" width="500px"/>'
                    , area: ['auto', 'auto']
                    , id: "",
                })
            } else if (obj.event === 'del') {
                layer.confirm('真的删除该信息吗', function (index) {
                    $.ajax({
                        type: "post",
                        url: "admin/deBorrower",
                        data: {"id": data.id},
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
            } else if (obj.event === 'edit') {
                layer.open({
                    type: 2,
                    title: "借阅人修改",
                    content: "admin/upBorrowerView?id=" + data.id,
                    area: ['800px', '600px'],
                    id: "500",
                });
            }
        });
    });

    function open_layer() {
        layer.open({
            type: 2,
            title: "图书添加",
            content: "addBorrowerView",
            area: ['800px', '600px'],
            id: "600",
        });
    }
</script>
</html>