<?php /*a:1:{s:50:"D:\phpstudy_pro\WWW\thinkPHP\view\index\index.html";i:1680079546;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>案例展示</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <style type="text/css">
        table {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }

        table td, table th {
            border: 1px solid #cad9ea;
            color: #666;
            height: 50px;
        }

        table {
            table-layout: fixed;
        }

        table tbody td {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        table thead th {
            background-color: #CCE8EB;
            width: 100px;
        }

        table tr:nth-child(odd) {
            background: #fff;
        }

        table tr:nth-child(edataen) {
            background: #F5FAFA;
        }

        ul {
            border: 0;
            margin: 0;
            padding: 0;
        }

        #pagination-flickr {
            margin-top: 20px;
            display: inline-block;
            width: 400px;
        }

        #pagination-flickr li {
            border: 0;
            margin: 0;
            padding: 0;
            font-size: 17px;
            list-style: none;
        }

        #pagination-flickr a {
            border: solid 1px #DDDDDD;
            margin-right: 2px;
        }

        #pagination-flickr .previous-off,
        #pagination-flickr .next-off {
            color: #666666;
            display: block;
            float: left;
            font-weight: bold;
            padding: 3px 4px;
        }

        #pagination-flickr .next a,
        #pagination-flickr .previous a {
            font-weight: bold;
            border: solid 1px #FFFFFF;
        }

        #pagination-flickr .active {
            color: #ff0084;
            font-weight: bold;
            display: block;
            float: left;
            padding: 4px 6px;
        }

        #pagination-flickr a:link,
        #pagination-flickr a:visited {
            color: #0063e3;
            display: block;
            float: left;
            padding: 3px 6px;
            text-decoration: none;
        }

        #pagination-flickr a:hover {
            border: solid 1px #666666;
        }

        .border-size {
            font-size: 12px;
            height: 28px;
            line-height: 28px;
        }

        .add_btn {

        }

        .search_input {
            width: 250px;
            position: absolute;
        }

        .search_btn {
            position: relative;
            float: left;
            margin-left: 270px;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<table width="90%" class="table">
    <caption style="margin-bottom: 15px">
        <h2>
            案例列表</h2>
        <form class="layui-form" action="index" id="search_form" method="get">
            <div class="search_input">
                <input type="text" name="keywords" value="<?php echo htmlentities($keywords); ?>"  placeholder="请输入关键字搜索" autocomplete="off"
                       class="layui-input">
            </div>
            <div class="search_btn layui-anim layui-anim-down">
                <button class="layui-btn" id="search_btn" type="button">搜索</button>
            </div>
        </form>
        <div class="add_btn">
            <input type="button" style="float:left;" value="添加" class="layui-btn layui-btn-normal" onclick="case_add()">
        </div>
    </caption>

    <thead>

    <tr>
        <th>
            序号
        </th>
        <th>
            标题
        </th>
        <th>
            类型名称
        </th>
        <th>
            关键字
        </th>
        <th>
            简介
        </th>
        <th>
            时间
        </th>
        <th>
            操作
        </th>
    </tr>
    </thead>
    <?php if(is_array($case_arr["data"]) || $case_arr["data"] instanceof \think\Collection || $case_arr["data"] instanceof \think\Paginator): $i = 0; $__LIST__ = $case_arr["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
    <tr>
        <td><?php echo htmlentities($data['cid']); ?></td>
        <td><?php echo htmlentities($data['ctitle']); ?></td>
        <td><?php echo htmlentities($data['caseType']['ctname']); ?></td>
        <td><?php echo htmlentities($data['ckeywords']); ?></td>
        <td title="<?php echo htmlentities($data['cdescribe']); ?>"><?php echo htmlentities($data['cdescribe']); ?></td>
        <td><?php echo htmlentities($data['time']); ?></td>
        <td><input type="button" value="修改" onclick="updata_case(<?php echo htmlentities($data['cid']); ?>)"
                   class="layui-btn layui-btn-normal border-size">
            <input type="button" value="删除" onclick="delete_data(<?php echo htmlentities($data['cid']); ?>)"
                   class="layui-btn layui-btn-danger border-size"></td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<center>
    <ul id="pagination-flickr">
        <li class="next"><a href="" onclick="up_page(this)">«上一页</a></li>
        <li><a href="">当前页<?php echo htmlentities($case_arr['current_page']); ?></a></li>
        <li><a href="">总页<?php echo htmlentities($case_arr['last_page']); ?></a></li>
        <li class="next"><a href="" onclick="next_page(this)">下一页»</a></li>
    </ul>
</center>
</body>
</html>
<script src="/static/layui/layui.js"></script>
<script src="/static/js/jquery-3.js"></script>
<script>
    $('#search_btn').click(function (){
        $("#search_form").submit();
    });
    var current_page = <?php echo htmlentities($case_arr['current_page']); ?>;
    var last_page = <?php echo htmlentities($case_arr['last_page']); ?>;



    function next_page(e) {
        if (current_page < last_page) {
            e.href = '?page=' + (current_page + 1)+'&&keywords=<?php echo htmlentities($keywords); ?>';
        }
    }

    function up_page(e) {
        if (current_page > 1) {
            e.href = '?page=' + (current_page - 1)+'&&keywords=<?php echo htmlentities($keywords); ?>';
        }
    }

    layui.use('layer', function () {
        var layer = layui.layer;
    });

    function delete_data(id) {
        $.ajax({
            type: 'post',
            url: 'index/deletedata',
            data: {"id": id},
            dataType: 'json',
            success: function (res) {
                if (res.code == 1) {
                    layer.msg(res.msg, {icon: 1});
                    setTimeout('window.location.reload()', 500);
                } else {
                    layer.msg(res.msg, {icon: 0});
                }
            },
            error: function () {
                alert("服务器连接失败");
            }
        });
    }

    function case_add() {
        layer.open({
            type: 2,
            title: "案例添加",
            content: "index/casesAdd",
            area: ['800px', '500px'],
        });
    }

    function updata_case(id) {
        layer.open({
            type: 2,
            title: "案例修改",
            content: "index/caseUpShow?id=" + id,
            area: ['800px', '500px'],
        });
    }
</script>