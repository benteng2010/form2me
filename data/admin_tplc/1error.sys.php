<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<Meta http-equiv="Expires" Content="Wed, 26 Feb 1997 08:21:57 GMT">
<Meta http-equiv="Pragma" Content="No-cach">
<title>友情提示 -- Powered By PhpOK.Com</title>
<script language="JavaScript">
function moveNew()
{
	window.location.href="<?php echo $url;?>";
}
<?php $mir_time = $time*1000;?>
window.setTimeout("moveNew()","<?php echo $mir_time;?>");
</script>
<style type="text/css">
td
{
	font:normal 12px "Tahoma","Arial","serif","sans-serif";
}
a,a:visited
{
	font:normal 12px "Tahoma","Arial","serif","sans-serif";
	color: #000000;
	text-decoration: none
}

a:hover
{
	color: #FF0000;
	text-decoration:none;
}

</style>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="90%" align="center">
<tr>
	<td style="border:1px #2693FF solid;background:#CAE4FF;padding:10px;text-align:center;"><?php echo $errmsg;?><br /><br /><a href="<?php echo $url;?>">若系统无法在 <span style='color:red;font-weight:bold'><?php echo $time;?></span> 秒后自动跳转，请手动点击</a>
	</td>
</tr>
</table>
<?php QG_C_TEMPLATE::p("foot","","0");?>