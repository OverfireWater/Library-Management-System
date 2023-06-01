<?php /*a:1:{s:66:"D:\phpstudy_pro\WWW\thinkPHP\app\book_manage\view\admin\index.html";i:1683385944;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<!--[if lt IE 9]>
<![endif]-->
		<link rel="icon" href="/favicon111.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="/static/RBAC_server/css/H-ui.min.css" />
		<link rel="stylesheet" type="text/css" href="/static/RBAC_server/css/H-ui.admin.css" />
		<link rel="stylesheet" type="text/css" href="/static/RBAC_server/css/Hui-iconfont/1.0.8/iconfont.css" />
		<link rel="stylesheet" type="text/css" href="/static/RBAC_server/skin/default/skin.css" id="skin" />
		<link rel="stylesheet" type="text/css" href="/static/RBAC_server/css/style.css"/>
		<!--[if IE 6]>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
		<title>oa管理系统</title>
		<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
		<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
	</head>

	<body>
		<header class="navbar-wrapper">
			<div class="navbar navbar-fixed-top">
				<div class="container-fluid cl">
					<a class="logo navbar-logo f-l mr-10 hidden-xs" href=""><img src="/static/RBAC_server/img/librarycolor_yello.png" width="100" height="40" alt=""></a>
					<span class="logo navbar-slogan f-l mr-10 hidden-xs">图书管理系统</span>
					<a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>

					<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
						<ul class="cl">
							<li>欢迎</li>
							<li class="dropDown dropDown_hover">
								<a href="#" class="dropDown_A"><?php echo htmlentities($user['BerName']); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
								<ul class="dropDown-menu menu radius box-shadow">

									<li>
										<a href="login_exit">退出</a>
									</li>
								</ul>
							</li>
							<li id="Hui-skin" class="dropDown right dropDown_hover">
								<a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
								<ul class="dropDown-menu menu radius box-shadow">
									<li>
										<a href="javascript:;" data-val="default" title="默认（绿色）">默认（绿色）</a>
									</li>
									<li>
										<a href="javascript:;" data-val="blue" title="蓝色">蓝色</a>
									</li>
									<li>
										<a href="javascript:;" data-val="red" title="红色">红色</a>
									</li>
									<li>
										<a href="javascript:;" data-val="yellow" title="黄色">黄色</a>
									</li>
									<li>
										<a href="javascript:;" data-val="orange" title="橙色">橙色</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
		<aside class="Hui-aside">
			<div class="menu_dropdown bk_2">

				<dl id="menu-admin">
					<dt><i class="Hui-iconfont">&#xe62d;</i> 图书管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="bookInfo" data-title="图书列表" href="javascript:void(0)">图书列表</a>
							</li>
							<li>
								<a data-href="bookOld" data-title="旧书记录表" href="javascript:void(0)">旧书记录表</a>
							</li>
							<li>
								<a data-href="bookTypeInfo" data-title="图书类型" href="javascript:void(0)">图书类型</a>
							</li>
							<li>
								<a data-href="PressInfo" data-title="出版社信息" href="javascript:void(0)">出版社信息</a>
							</li>
							<li>
								<a data-href="bookReView" data-title="书评信息" href="javascript:void(0)">书评信息</a>
							</li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-role">
					<dt><i class="Hui-iconfont">&#xe62d;</i> 借阅管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="borrower" data-title="借阅人列表" href="javascript:void(0)">借阅人列表</a>
							</li>
							<li>
								<a data-href="bookBorrowerRecordView" data-title="借阅记录表" href="javascript:void(0)">借阅记录表</a>
							</li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-lose">
					<dt><i class="Hui-iconfont">&#xe62d;</i> 挂失管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="bookloss" data-title="挂失" href="javascript:void(0)">挂失记录表</a>
							</li>
						</ul>
					</dd>
				</dl>
				<dl id="menu-system1">
					<dt><i class="Hui-iconfont">&#xe62e;</i> 账号管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li>
								<a data-href="upPersonInfo" data-title="个人中心" href="javascript:void(0)">个人中心</a>
								<a data-href="upPersonPwd" data-title="修改密码" href="javascript:void(0)">修改密码</a>
							</li>
						</ul>
					</dd>
				</dl>
			</div>
		</aside>

		<section class="Hui-article-box">
			<div id="Hui-tabNav" class="Hui-tabNav hidden-xs" style="display: none">
				<div class="Hui-tabNav-wp">
					<ul id="min_title_list" class="acrossTab cl">
						<li class="active">
							<span title="我的桌面" data-href="role.html">我的桌面</span>
							<em></em></li>
					</ul>
				</div>
				<div class="Hui-tabNav-more btn-group">
					<a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
					<a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
				</div>
			</div>
			<div id="iframe_box" class="">
				<div class="show_iframe">
					<iframe scrolling="yes" frameborder="0" src="bookInfo"></iframe>
				</div>
			</div>
		</section>
		<!--_footer 作为公共模版分离出去-->
		<script type="text/javascript" src="/static/RBAC_server/js/jquery.min.js"></script>
		<script type="text/javascript" src="/static/RBAC_server/js/layer.js"></script>
		<script type="text/javascript" src="/static/RBAC_server/js/H-ui.min.js"></script>
		<script type="text/javascript" src="/static/RBAC_server/js/H-ui.admin.js"></script>
		<!--/_footer 作为公共模版分离出去-->
</body>
</html>