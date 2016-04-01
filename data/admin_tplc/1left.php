<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
<!-- 后台左侧菜单 -->
<link rel="stylesheet" type="text/css" href="admin/tpl/images/left.css" />
<body>
<!-- 系统设置 -->
<div onClick="menu_set('menu_system')" class="menu_title">&nbsp; 系统设置</div>
<div id="menu_system" class="menu_son">
	<div class="menu_list">
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href="admin.php?file=setpass&act=setpass" target="main">更改密码</a><?php if($QG_AP[notice]){?> |
		<a href='admin.php?file=notice&act=list' target='main'>公告管理</a><?php } ?>
	</div>
	<?php if($_SESSION[admin][typer] == "system"){?>
	<div class="menu_list">
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href="admin.php?file=system&act=set" target="main">网站常规设置</a> |
		<a href="admin.php?file=status" target="main">网站开关</a>
	</div>
	<?php } ?>
	<?php if($_SESSION[admin][typer] == "system"){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=sysgroup&act=list' target='main'>管理系统组</a> | 
		<a href='admin.php?file=adminer&act=list' target='main'>管理员</a>
	</div>
	<?php } ?>
	<?php if($QG_AP[orderlist]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href="admin.php?file=order&act=list" target="main">订单管理</a>
	</div>
	<?php } ?>
	<?php if($QG_AP[user]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=user&act=list' target='main'>会员档案</a>
	</div>
	<?php } ?>
</div>

<div onClick="menu_set('menu_content')" class="menu_title">&nbsp; 内容管理</div>
<div id="menu_content" class="menu_son">
	<?php $_i=0;$left_menu=(is_array($left_menu))?$left_menu:array();foreach($left_menu AS  $key=>$value){$_i++; ?>
		<?php $m = "msg_".$value[id];?>
		<?php if($QG_AP[$m] || $_SESSION[admin][typer] == "system"){?>
		<div class='menu_list'>
			<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
			<?php if($value[id]==4){?>
			<a href='admin.php?file=form&act=list&sysgroupid=<?php echo $value[id];?>' target='main'><?php echo $value[groupname];?>信息管理</a> |
			<?php }else{ ?>
			<a href='admin.php?file=msg&act=list&sysgroupid=<?php echo $value[id];?>' target='main'><?php echo $value[groupname];?>信息管理</a> |
			<?php } ?>
			<a href="admin.php?file=category&act=list&sysgroupid=<?php echo $value[id];?>" target="main">分类</a>
		</div>
		<?php } ?>
	<?php } ?>
</div>

<div onClick="menu_set('qg_other');" class='menu_title'>&nbsp; 其他管理</div>
<div id='qg_other' class='menu_son'>
	<?php if($QG_AP[link] || $QG_AP[vote]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<?php if($QG_AP[link]){?><a href='admin.php?file=link&act=list' target='main'>友情链接</a><?php } ?>
		<?php if($QG_AP[link] && $QG_AP[vote]){?> | <?php } ?>
		<?php if($QG_AP[vote]){?><a href='admin.php?file=vote&act=list' target='main'>投票管理</a><?php } ?>
	</div>
	<?php } ?>

	<?php if($QG_AP[online] || $QG_AP[nav]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<?php if($QG_AP[online]){?><a href='admin.php?file=online' target='main'>客服代码</a><?php } ?>
		<?php if($QG_AP[online] && $QG_AP[nav]){?> | <?php } ?>
		<?php if($QG_AP[nav]){?><a href='admin.php?file=nav&act=list' target='main'>导航管理</a><?php } ?>
	</div>
	<?php } ?>

	<?php if($QG_AP[book_feedback]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=book&act=list' target='main'>留言信息</a> | <a href='admin.php?file=feedback&act=list' target='main'>反馈管理</a>
	</div>
	<?php } ?>

	<?php if($QG_AP[book_feedback]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=job&act=list' target='main'>招聘管理</a> |
		<a href="admin.php?file=job&act=applist" target="main">应聘信息</a>
	</div>
	<?php } ?>

	<?php if($QG_AP[ad] || $QG_AP[special]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<?php if($QG_AP[ad]){?><a href='admin.php?file=phpok&act=list' target='main'>广告管理</a><?php } ?>
		<?php if($QG_AP[ad] && $QG_AP[special]){?> | <?php } ?>
		<?php if($QG_AP[special]){?><a href='admin.php?file=special&act=list' target='main'>单页面管理</a><?php } ?>
	</div>
	<?php } ?>

	<?php if($_SESSION[admin][typer] == "system"){?>
		<?php if($dbType=='sqlite'){?>
		
		<?php }elseif($dbType=='mysql'){ ?>
		<div class='menu_list'>
		
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=sqlbak&act=list' target='main'>数据库管理</a> |
		<a href='admin.php?file=sqlbak&act=qgrecover' target='main'>恢复</a>
	</div>
	<?php } ?>
	<?php } ?>

	<?php if($QG_AP[picplay]){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=index.img&act=set' target='main'>图片播放管理</a>
	</div>
	<?php } ?>

	<?php if($_SESSION[admin][typer] == "system"){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=email&act=status' target='main'>设置邮件通知</a> |
		<a href="admin.php?file=email&act=msg" target="main">邮件内容</a>
	</div>
	<?php } ?>

	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href="admin.php?file=email&act=send" target="main">在线发送邮件</a>
	</div>

	<?php if($_SESSION[admin][typer] == "system"){?>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=language&act=list' target='main'>语言包管理</a> |
		<a href='admin.php?file=tpl&act=list' target='main'>风格管理</a>
	</div>
	<?php } ?>
</div>

<div onClick="menu_set('son_upfils');" class='menu_title'>&nbsp; 上传文件管理</div>
<div id='son_upfils' class='menu_son'>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=upfiles&act=add_link' target='main'>添加FTP上传文件链接</a>
	</div>
	<div class='menu_list' id="xupfiles_qgchk">
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=upfiles&act=add_xupfiles' target='main'>Xupfiles大文件上传</a>
	</div>
	<div class='menu_list'>
		<img src="admin/tpl/images/preicon.gif" border="0" align="absmiddle">
		<a href='admin.php?file=upfiles&act=upfiles' target='main'>小文件上传</a> |
		<a href='admin.php?file=upfiles&act=list' target='main'>文件管理</a>
	</div>
</div>

<script language="javascript1.2">
function menu_set(nid)
{
	if($(nid).style.display == "none")
	{
		$(nid).style.display = "";
	}
	else
	{
		$(nid).style.display = "none";
	}
}
if(qgIE == "FF")
{
	$("xupfiles_qgchk").style.display = "none";
}
</script>