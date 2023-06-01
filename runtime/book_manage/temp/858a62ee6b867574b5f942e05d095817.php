<?php /*a:1:{s:80:"C:\PHP\WWW\kzy\Library-Management-System\app\book_manage\view\admin\welcome.html";i:1685082806;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <!--<link rel="stylesheet" href="./css/font.css">-->
        <link rel="stylesheet" href="/static/book_manage/wecome/css/index.css">
        <link rel="stylesheet" href="/static/layui/css/layui.css">
        <script src="/static/layui/layui.js" charset="utf-8"></script>
        <style>
            #FontScroll{
                width: 100%;
                height: 245px;
                overflow: hidden;
            }
            #FontScroll ul li{
                height: 32px;
                width: 100%;
                color: #ffffff;
                line-height: 32px;
                overflow: hidden;
                font-size: 14px;
            }
            #FontScroll ul li i{
                color: red;
            }
            .layui-table td, .layui-table th{
                min-width: auto !important;
            }
            .layui-p{
                line-height: 20px;
                padding: 9px;
                text-align: left;

            }
        </style>
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">数据统计</div>
                        <div class="layui-card-body">
                            <ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>已借书籍数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($jie); ?>本</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>未归还数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($book_record); ?>本</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>仓库数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($can_count); ?>本</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>上架数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($shang); ?>本</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>挂失数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($gua); ?>本</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>报废数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($baofei); ?>本</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>总借阅用户数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($borrower); ?>人</cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-md2 layui-col-xs6">
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>总书籍数量</h3>
                                        <p>
                                            <cite><?php echo htmlentities($book_count); ?>本</cite></p>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-card-header">网站信息</div>
            <form class="layui-form" id="form_data" style="width: 50%;margin-left: 15px;margin-top: 15px" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label" >网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name"  required lay-verify="required|ZHCheck" value="<?php echo htmlentities($webInfo['webname']); ?>" placeholder="请输入网站名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图书显示条数</label>
                    <div class="layui-input-inline">
                        <input type="number" name="number" oninput = "value=value.replace(/[^\d]/g,'')" required lay-verify="required|ZHCheck" value="<?php echo htmlentities($webInfo['book_num']); ?>" placeholder="请输入网站名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" id="file_sub" lay-submit lay-filter="formDemo">立即修改</button>
                    </div>
                </div>
            </form>

            <script>
                //Demo
                layui.use(['layer','form','jquery'], function(){
                    var layer=layui.layer
                        ,form=layui.form
                        ,$=layui.$;
                  form.on('submit(formDemo)',function (data){
                      var form_data=new FormData($("#form_data")[0]);
                      form_data.append("id",<?php echo htmlentities($webInfo['id']); ?>);
                      $.ajax({
                          type:"post",
                          url:"/index.php/book_manage/admin/up_data_webinfo",
                          data:form_data,
                          dataType:"json",
                          processData:false,
                          contentType:false,
                          success(res){
                              if (res.code===0){
                                  layer.msg(res.msg)
                                  setTimeout('parent.location.reload()', 500);
                              }else{
                                  layer.msg(res.msg)
                              }
                          }
                          ,error(){
                              layer.msg("服务器连接失败")
                          }
                      })
                      return false;
                  })
                });
            </script>
        </div>
    </body>

</html>