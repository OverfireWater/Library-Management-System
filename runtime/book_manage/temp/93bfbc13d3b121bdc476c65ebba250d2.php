<?php /*a:1:{s:69:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\admin\bookInfo.html";i:1682587697;}*/ ?>
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

        .layui-table-cell {
            height: 70px;
            line-height: 70px;
        }

        th .layui-table-cell {
            height: 38px;
            line-height: 38px;
            text-align: "center";
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
                           placeholder="输入图书名称|作者" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" id="form_btn" data-type="reload">搜索</button>
                <button class="layui-btn layui-btn-normal" type="button" lay-filter="formDemo" onclick="open_layer()">
                    图书添加
                </button>
            </div>
        </div>
    </div>

    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>
</body>
<script type="text/html" id="switchTpl">
    {{# if(d.BIsOld==1) { }}
    <span style="color: #5c32f3">旧书</span>
    {{# } else if(d.BIsOld==0){ }}
    <span style="color: #30d927">新书</span>
    {{# } }}
</script>

<script type="text/html" id="state">
    {{# if(d.BState==1) { }}
    <span style="color: #55d05b">上架</span>
    {{# } else if(d.BState==0){ }}
    <span>仓库</span>
    {{# } else if(d.BState==2) { }}
    <span style="color: #0a6999">外借</span>
    {{# } else if(d.BState==3) { }}
    <span style="color: red">丢失</span>
    {{# } else { }}
    <span style="color: #bdb368">报废</span>
    {{# } }}
</script>

<script type="text/html" id="show_img">
    <img src="{{d.BUrl}}" alt="" style="cursor: pointer;width: 50px;height: 70px">
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="upState">修改状态</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table', 'layer', 'form'], function () {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        table.render({
            elem: '#test'
            , url: 'admin/get_bookInfo_data'
            , title: '用户数据表'
            , cellMinWidth: 100
            , cols: [[
                {field: 'id', title: '序号', fixed: 'left', width: 80, unresize: false, sort: true,align:"center"}
                , {field: 'BNo', title: '图书编号',align:"center",width: 120}
                , {field: 'BUrl', title: '封面', templet: "#show_img", event: "seePic", width: 80}
                , {field: 'Bisbn', title: 'ISBN标准书号', width: 140 ,align:"center"}
                , {field: 'BName', title: '图书名称', width: 140,align:"center"}
                , {field: 'BTName', title: '图书类型',align:"center"}
                , {field: 'PressName', title: '出版社信息',align:"center"}
                , {field: 'BAuthor', title: '作者',align:"center"}
                , {field: 'BPrice', title: '定价',align:"center"}
                , {field: 'BIsOld', title: '新书|旧书', templet: '#switchTpl',width: 90}
                , {field: 'BState', title: '状态', templet: "#state",align:"center",width: 60}
                , {field: 'SRemark', title: '简介',align:"center"}
                , {fixed: 'right', title: '操作', width: 200, toolbar: '#barDemo',align:"center"}
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
                layer.confirm('真的删除行么', function (index) {
                    $.ajax({
                        type: "post",
                        url: "admin/deBookInfo",
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
                    title: "图书修改",
                    content: "admin/upBookInfoView?id=" + data.id,
                    area: ['800px', '600px'],
                    id: "500",
                });
            }else if (obj.event==="upState"){
                layer.open({
                    type: 2,
                    title: "状态修改",
                    content: "admin/upBookStateView?id="+data.id+"&stateId=" + data.BState,
                    area: ['600px', '400px'],
                    id: "600",
                });
            }
        });
    });

    function open_layer() {
        layer.open({
            type: 2,
            title: "图书添加",
            content: "admin/addBookInfoView",
            area: ['800px', '600px'],
            id: "600",
        });
    }
</script>
</html>