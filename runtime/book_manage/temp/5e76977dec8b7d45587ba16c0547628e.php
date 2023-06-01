<?php /*a:1:{s:67:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\admin\bookInfo.html";i:1681887668;}*/ ?>
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
        .cBody{
            margin: 20px;
        }
    </style>
</head>
<body>

<div class="cBody" >
    <div class="console">
        <div class="demoTable">
            <div class="layui-form-item">
                <div class="layui-input-inline">
                    <input type="text" name="keywords"  id="keywords" required lay-verify="required" placeholder="输入部门名称" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" id="form_btn" data-type="reload" >检索</button>
                <button class="layui-btn layui-btn-normal" type="button" lay-filter="formDemo" onclick="open_layer()">部门添加</button>
            </div>
        </div>
    </div>

    <table class="layui-hide" id="test" lay-filter="test"></table>
</div>
</body>

<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script>
    layui.use(['table','layer','form'], function () {
        var table = layui.table;
        var layer=layui.layer;
        var form = layui.form;
        table.render({
            elem: '#test'
            , url: 'admin/get_depart_data'
            ,title: '用户数据表'
            , cols: [[
                {field: 'id', title: 'ID',  fixed: 'left',width: 150, unresize: false, sort: true}
                , {field: 'BAuthor', title: '部门名称', }
                ,{fixed: 'right', title:'操作',width:128, toolbar: '#barDemo'}
            ]]
            , page: true
            ,id:"testreload"
        });
        //表格重载
        var  active = {
            reload: function(){
                var keywords = $('#keywords');

                //执行重载
                table.reload('testreload', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: {
                        keywords: keywords.val()
                    }
                });
            }
        };

        $('.demoTable #form_btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
            console.log(type);
            console.log(active[type]);
        });
        //监听行工具事件
        table.on('tool(test)', function (obj) {
            var data = obj.data;
            // console.log(data.ptid);
            if (obj.event === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    $.ajax({
                        type:"post",
                        url:"admin/deDepart",
                        data:{"id":data.id },
                        dataType:"json",
                        success:function (result){
                            if (result.code==0){
                                layer.msg(result.msg);
                                obj.del();
                                setTimeout('window.location.reload("#test")',500);
                            }else if (result.code==1){
                                lay.msg(result.msg);
                            }
                        },
                        error:function (){
                            layer.msg("数据错误");
                        }
                    });
                    layer.close(index);
                });
            } else if (obj.event === 'edit') {
                    layer.open({
                        type:2,
                        title:"部门修改",
                        content:"admin/upDepartview?id="+data.id,
                        area:['800px','400px'],
                        id:"500",
                    });
                    layer.close(index);
            }
        });
    });
    function open_layer(){
        layer.open({
            type:2,
            title:"部门添加",
            content:"addDepart",
            area:['800px','400px'],
            id:"600",
        });
    }
</script>
</html>