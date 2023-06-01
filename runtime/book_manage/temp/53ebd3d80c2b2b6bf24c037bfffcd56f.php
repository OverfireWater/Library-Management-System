<?php /*a:1:{s:90:"D:\phpstudy_pro\WWW\Library-Management-System\app\book_manage\view\admin\borrowerInfo.html";i:1685610997;}*/ ?>
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
                           placeholder="输入借阅人|账号|用户昵称|身份证|手机号" title="输入借阅人|账号|用户昵称|身份证|手机号" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" id="form_btn" data-type="reload">搜索</button>
                <button class="layui-btn layui-btn-warm" id="resert" type="reset" data-type="resert">重置</button>
                <button class="layui-btn layui-btn-normal" type="button" lay-filter="formDemo" onclick="open_layer()">
                    用户添加
                </button>
            </div>
        </div>
    </div>

    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>
</body>


<script type="text/html" id="state">
    {{# if(d.BerRole==1) { }}
    <span style="color: #55d05b">学生</span>
    {{# } else if(d.BerRole==0){ }}
    <span style="color: red">管理员</span>
    {{# } else if(d.BerRole==2) { }}
    <span style="color: #0a6999">普通老师</span>
    {{# } else if(d.BerRole==3) { }}
    <span >管理老师</span>
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
        var page;
        table.render({
            elem: '#test'
            , url: 'admin/get_borrower_data'
            , title: '用户数据表'
            , cellMinWidth: 100
            , cols: [[
                {field: 'id', title: '序号', fixed: 'left', width: 80, unresize: false, sort: true,align:"center"}
                , {field: 'BerAccount', title: '账号',align:"center"}
                , {field: 'BerName', title: '用户昵称', width: 140 ,align:"center"}
                , {field: 'BerCardId', title: '身份证号', width: 140,align:"center"}
                , {field: 'BerPhone', title: '手机号',align:"center"}
                , {field: 'BerRole', title: '角色类型',align:"center",templet: "#state"}
                , {field: 'BerBTime', title: '注册时间',align:"center"}
                , {fixed: 'right', title: '操作', width: 190, toolbar: '#barDemo',align:"center"}
            ]]
            , page: true
            , height: 'full-30'
            , id: "testreload"
            ,done(res, curr){
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
                                table.reloadData('testreload', {
                                    page: {
                                        curr: page_curr
                                    }
                                });
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
                var up_BerRole=data.BerRole
                var up_account=data.BerAccount
                $.ajax({
                    type:'get',
                    url:'/index.php/book_manage/admin/borrowerRole',
                    dataType: 'json',
                    success(res){
                        if (res.code==0){
                            var role=res.data.role
                            var account=res.data.username
                            if (role==3 && (up_BerRole==0 || up_BerRole==3)){
                                layer.msg('你没有修改此管理员的权限');
                            }else {
                                layer.open({
                                    type: 2,
                                    title: "借阅人修改",
                                    content: "admin/upBorrowerView?id=" + data.id,
                                    area: ['800px', '600px'],
                                    id: "600",
                                });
                            }
                        }
                    }
                })
            }
        });
    });

    function open_layer() {
        layer.open({
            type: 2,
            title: "用户添加",
            content: "addBorrowerView",
            area: ['800px', '600px'],
            id: "600",
        });
    }
</script>
</html>