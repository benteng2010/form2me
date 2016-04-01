<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="templates/zh/default/images/style.css" />
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="templates/zh/default/images/jquery-ui-1.8.7.custom.css" />
<script type="text/javascript" src="templates/zh/default/images/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="templates/zh/default/images/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="templates/zh/default/images/EmailMeForm.js"></script>
<script src="templates/zh/default/images/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<!--[if lte IE 6]>
<script src="templates/zh/default/images/DD_belatedPNG_0.0.8a.js" type="text/javascript"></script>
<script type="text/javascript">DD_belatedPNG.fix('div, ul, img, li, input , a');</script>
<![endif]-->
<style type="text/css">
body {
	background: url("templates/zh/default/images/footer-bg_02.jpg") repeat-x scroll left bottom transparent;
	color: #666666;
	font-family: Arial, Georgia, Verdana, Lucida, "Trebuchet MS", Helvetica, Tahoma, sans-serif;
	font-size: 12px;
	text-align: center;
}
#outer {
	background: url("templates/zh/default/images/top-bg.jpg") repeat-x scroll 0 0px transparent;
	height: 100%;
	width: 100%;
}
#header_logo {
	width: 300px;
	float:left;
}
#wrap {
	height: 100%;
	margin: 0 auto;
	position: relative;
	text-align: left;
	width: 967px;
}
#bar {
	height: 60px;
	float:left;
	position:relative;
}
#nav {
	padding-top:80px;
	padding-left:25px;
	_padding-left:5px;
	float:left;
}
#nav li {
	float: left;
	width:117px;
	height:49px;
}
#nav li .selected {
	color: #666666;
}
#nav li a {
	color: #FFFFFF;
	display: block;
	float: left;
	height: 49px;
	text-align: center;
	text-decoration: none;
	width: 117px;
}
#nav li a b {
	cursor: pointer;
	display: block;
	line-height:49px;
	font-size:14px;
	font-weight:bold;
	font-family:"微软雅黑", "宋体";
}
#nav li a:hover, #nav li a:hover b {
	text-decoration:underline;
}
.fuyou {
	color:#515050 !important;
	background:url(templates/zh/default/images/hove.jpg);
}
#nav-right {
	color: #FFFFFF;
	float: left;
	width:300px;
	text-align:center;
	padding-top:15px;
	padding-left:30px;
}
#nav-right .account-info {
	bottom: 18px;
	font-size: 14px;
	font-weight: bold;
	position: absolute;
	right: 4px;
	white-space: nowrap;
}
#nav-right li {
	float: left;
}
#nav-right li a {
	color: #FFFFFF;
	padding-left: 5px;
	padding-right: 5px;
	text-decoration:none;
}
#maincon-wrap, #maincon-wrap-notifications {
	float: left;
	padding-top: 26px;
	position: relative;
	width: 967px;
}
#maincon-wrap #filter {
	display: block;
	left: 5px;
	position: absolute;
	top: 45px;
}
#maincon-wrap h3, #maincon-wrap-notifications h3 {
	font-size: 24px;
	font-weight: bold;
}
#maincon-wrap h4, #maincon-wrap-notifications h4 {
	font-size: 14px;
}
#maincon-wrap #filter label {
	font-weight: bold;
}
#maincon-wrap a img, #maincon-wrap-notifications a img {
	display: block;
	position: absolute;
	right: 6px;
	top: 40px;
}
#maincon {
	background: url("templates/zh/default/images/main-bd-bg.gif") repeat-y scroll left top transparent;
}
#maincon-hd {
	background: url("templates/zh/default/images/main-hd-bg.gif") no-repeat scroll left top transparent;
}
#maincon-ft {
	background: url("templates/zh/default/images/main-ft-bg.gif") no-repeat scroll left bottom transparent;
}
#maincon-mamager {
	padding: 20px;
}
.bar_xg{
	position:absolute;
	top:90px;
	right:-300px;
	_right:-315px;
}
.bar_xg a{
	display:block;
	float:left;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	color:#fff;
	text-decoration:none;
	height:26px;
	line-height:26px;
	margin-right:20px;
}
.sjxs{
	padding-left:30px;
	background-image: url(templates/zh/default/images/edit-themes8_03.jpg);
	background-repeat: no-repeat;
	background-position: left center;
}
.qq2me{
	padding-left:30px;
	background-image: url(templates/zh/default/images/edit-themes8_05.jpg);
	background-repeat: no-repeat;
	background-position: left center;
}
.sms2me{
	padding-left:30px;
	background-image: url(templates/zh/default/images/edit-themes8_08.jpg);
	background-repeat: no-repeat;
	background-position: left center;
}
</style>
</head>

<body style="margin:0px;padding:0px;min-height:700px">
<div id="outer">
<div id="wrap">
<div id="form2me_head">
  <div id="header_logo">
  	<a href="home.php"> <img class="logo" alt="Email Me Form Logo" src="templates/zh/default/images/logo1.jpg"> </a>
    <div id="nav-right">
      <ul>
        <li><a href="my.php?file=usercp" ><b><?php echo $_SESSION[qg_sys_user][user];?></b></a>|</li>
        <li><a href="#"><b>帮助中心</b></a>|</li>
        <li><a href="login.php?act=logout"><b>登出</b></a></li>
      </ul>
    </div>
  </div>
  <div id="bar">
    <ul id="nav">
      <li><a class="<?php if($controller=='formManage'){?>selected fuyou<?php } ?>" href="formManage.php"><b>我的表单</b></a></li>
      <li><a class="<?php if($controller=='themeManage'){?>selected fuyou<?php } ?>" href="themeManage.php?act=edit"><b>主题列表</b></a></li>
      <li><a class="<?php if($controller=='templateManage'){?>selected fuyou<?php } ?>" href="templateManage.php"><b>模板列表</b></a></li>
    </ul>
    <div class="bar_xg">
        <a href="#" class="sjxs">手机先生</a>
        <a href="#" class="qq2me">QQ2Me</a>
        <a href="#" class="sms2me">SMS2Me</a>
    </div>
  </div>
</div>