<?php /*a:1:{s:82:"D:\phpstudy_pro\WWW\Library-Management-System\app\book_manage\view\admin\test.html";i:1684581993;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>table 组件综合演示 - Layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/static/layui-2.8/layui/css/layui.css" rel="stylesheet">
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
<!--
本「综合演示」包含：自定义头部工具栏、获取表格数据、表格重载、自定义模板、单双行显示、单元格编辑、自定义底部分页栏、表格相关事件与操作、与其他组件的结合等相对常用的功能，以便快速掌握 table 组件的使用。
-->
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
<script type="text/html" id="switchTpl">
  {{# if(d.isloss){ }}
  <sapn>已找到</sapn>
  {{# } else { }}
  <span>未找到</span>
  {{# } }}
</script>
<script type="text/html" id="barDemo">
  <div class="layui-clear-space">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs" lay-event="more">
      更多
      <i class="layui-icon layui-icon-down"></i>
    </a>
  </div>
</script>
<script src="/static/layui-2.8/layui/layui.js"></script>
<script>
  layui.use(['table', 'dropdown','jquery'], function(){
    var table = layui.table;
    var dropdown = layui.dropdown;
    var $=layui.$;

    // 创建渲染实例
    table.render({
      elem: '#test'
      , url: '/index.php/book_manage/admin/get_book_loss_data'
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
      } else if(obj.event === 'more'){
        // 更多 - 下拉菜单
        console.log(this)
        dropdown.render({
          elem: this, // 触发事件的 DOM 对象
          show: true, // 外部事件触发即显示
          data: [{
            title: '查看',
            id: 'detail'
          },{
            title: '删除',
            id: 'del'
          }],
          click: function(menudata){
            if(menudata.id === 'detail'){
              layer.msg('查看操作，当前行 ID:'+ data.id);
            } else if(menudata.id === 'del'){
              layer.confirm('真的删除行 [id: '+ data.id +'] 么', function(index){
                obj.del(); // 删除对应行（tr）的DOM结构
                layer.close(index);
                // 向服务端发送删除指令
              });
            }
          },
          align:"right",
          style: 'box-shadow: 1px 1px 10px rgb(0 0 0 / 12%);' // 设置额外样式
        })
      }
    });
  });
</script>
</body>
</html>