<?php /*a:1:{s:85:"C:\PHP\WWW\kzy\Library-Management-System\app\book_manage\view\admin\bookLossInfo.html";i:1684912815;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="/static/layui-2.8/layui/css/layui.css">
    <script type="text/javascript" src="/static/layui-2.8/layui/layui.js"></script>
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

    </style>
</head>
<body>

<div class="cBody">
    <div class="console">
        <div class="demoTable">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <input type="text" name="keywords" id="keywords" required lay-verify="required"
                           placeholder="输入图书编号|丢失时间|图书状态" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" id="form_btn" data-type="reload">搜索</button>
                <button class="layui-btn layui-btn-warm" id="resert" type="reset" data-type="resert">重置</button>
            </div>
        </div>
    </div>

    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>
</body>
<script type="text/html" id="switchTpl">
    {{# if(d.isloss){ }}
    <sapn>已找到</sapn>
    {{# } else { }}
    <span>未找到</span>
    {{# } }}
</script>
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" id="more" lay-event="more">
        修改状态
        <i class="layui-icon layui-icon-down"></i>
    </a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除记录</a>
</script>
<script>
    layui.use(['table', 'layer', 'form', 'dropdown'], function () {
        var table = layui.table;
        var layer = layui.layer;
        var form = layui.form;
        var dropdown = layui.dropdown;
        var page_curr;
        table.render({
            elem: '#test'
            , url: 'admin/get_book_loss_data'
            , title: '用户数据表'
            , cellMinWidth: 100
            , cols: [[
                {field: 'RLRId', title: '序号', fixed: 'left', width: 80, unresize: false, sort: true, align: "center"}
                , {field: 'BNo', title: '图书编号', align: "center"}
                , {field: 'BLRTime', title: '挂失时间', align: "center"}
                , {field: 'isloss', title: '是否找到', align: "center", templet: "#switchTpl"}
                , {fixed: 'right', title: '操作', width: 200, toolbar: '#barDemo', align: "center"}
            ]]
            , page: true
            , height: 'full-100'
            , id: "testreload",
            done(res, curr, count){
                page_curr=curr
            }
        });
        $('.demoTable #form_btn').on('click', function () {
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
        });
        $("#resert").click(function (){
            $("#keywords").val("");
            table.reload('testreload', {
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where:{
                    keywords: ""
                }
            });
        })
        //监听行工具事件
        table.on('tool(test)', function (obj) {
            var data = obj.data;
            // console.log(data.ptid);
            if (obj.event === 'del') {
                layer.confirm('真的删除此数据吗？', function (index) {
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
                            table.reloadData('testreload', {
                                page: {
                                    curr: page_curr
                                }
                            });
                        },
                        error: function () {
                            layer.msg("数据错误");
                        }

                    });
                    layer.close(index);
                });
            } else if (obj.event === 'more') {
                // 更多 - 下拉菜单
                var flag = true;
                dropdown.render({
                    elem: this, // 触发事件的 DOM 对象
                    show: true, // 外部事件触发即显示
                    data: [{
                        title: '已找到',
                        id: 'yes_find'
                    }, {
                        title: '未找到',
                        id: 'no_find'
                    }],
                    click: function (menudata) {
                        if (menudata.id === 'yes_find') {
                            flag = true;
                        } else if (menudata.id === 'no_find') {
                            flag = false;
                        }
                        $.ajax({
                            type: "post",
                            url: "/index.php/book_manage/admin/upSwich_bookloss",
                            data: {"RLRId": data.RLRId, "BNo": data.BNo, "flag": flag},
                            dataType: "json",
                            success(res) {
                                if (res.code === 0) {
                                    layer.msg(res.msg);
                                } else if (res.code === 1) {
                                    layer.msg(res.msg)
                                }
                                table.reloadData('testreload', {
                                    page: {
                                        curr: page_curr
                                    }
                                });
                            }
                        })
                    },
                    align: "right",
                    style: 'box-shadow: 1px 1px 10px rgb(0 0 0 / 12%);' // 设置额外样式
                })
            }
        });
    });
</script>
</html>