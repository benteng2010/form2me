<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
<?php QG_C_TEMPLATE::p("right.css","","0");?>
<?php QG_C_TEMPLATE::p("right.head","","0");?>

<!-- 语言包管理 -->
<?php if($sysAct == "add"){?>
<div class="table2">
	&nbsp;<a href="admin.php?file=index">系统首页</a>
	&raquo; <a href="admin.php?file=language&act=list">语言包管理</a>
	&raquo; 添加语言包
	<input type="button" value="语言包管理" onclick="qgurl('admin.php?file=language&act=list')">
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<form method="post" action="admin.php?file=language&act=addok">
<tr>
	<td class="left">名称：</td>
	<td class="right">
		<input type="text" name="name" id="name">
		<span class="clue_on">[填写名称，可以是任何语言，但建议不要使用特殊符号]</span>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">唯一标识：</td>
	<td class="right">
		<input type="text" name="sign" id="sign">
		<span class="clue_on">[仅限英文字母、数字及下划线]</span>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">状态：</td>
	<td class="right">
		<table cellpadding="1" cellspacing="0">
		<tr>
			<td><input type="radio" name="status" id="status_1" value="1" checked></td>
			<td>使用</td>
			<td><input type="radio" name="status" id="status_0" value="0"></td>
			<td>停用</td>
			<td><span class="clue_on">[选择停用状态，当前语言将无法创建站点]</span></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">字段及内容：</td>
	<td class="right clue_on">一行一个字段。每一个字段用 {,} 分开，左边为变量名，右边为对应的内容。</td>
</tr>
</table>
</div>
<table width="100%">
<tr>
	<td><textarea style="width:500px;height:300px;" name="content" id="content"></textarea></td>
</tr>
</table>

<div class="table">
<table width="100%">
<tr>
	<td class="left">&nbsp;</td>
	<td class="right"><input type="submit" id="creat_button" class="mybutton_01" value="创建语言包"> &nbsp; <span id="show_step" style="color:red;"></span></td>
</tr>
</form>
</table>
</div>

<script type="text/javascript">
function add_msg(msg)
{
	var name = $("name").value;
	if(!name)
	{
		alert("语言名称不允许为空");
		return false;
	}
	var sign = $("sign").value;
	if(!sign)
	{
		alert("标识符不能为空");
		return false;
	}
	$("show_step").innerHTML = "<img src='admin/tpl/images/loading.gif' border='0' align='absmiddle'> 正在保存数据，如果网页没有动静请刷新...";
	$("creat_button").disabled = true;
}
</script>

<?php }elseif($sysAct == "list"){ ?>
<div class="table2">
	&nbsp;<a href="admin.php?file=index">系统首页</a>
	&raquo; <a href="admin.php?file=language&act=list">语言包管理</a>
	<input type="button" value="创建语言包" onclick="qgurl('admin.php?file=language&act=add')">
</div>

<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table>
<tr>
	<td class="left">
		<input type="button" value="编辑" class="mybutton_01" onclick="qg_modify(<?php echo $value[id];?>)">
		<?php if(!$value[ifsystem]){?>
		<input type="button" value="删除" class="mybutton_01" onclick="qg_delete(<?php echo $value[id];?>)">
		<?php } ?>
	</td>
	<td class="right">
		<?php if($value[ifuse]){?>
		<input type="button" value="已启用" class="mybutton_01" id="mybutton_<?php echo $value[id];?>" onclick="qg_status(<?php echo $value[id];?>)">
		<?php }else{ ?>
		<input type="button" value="已停用" class="mybutton_01" id="mybutton_<?php echo $value[id];?>" style="color:red;" onclick="qg_status(<?php echo $value[id];?>)">
		<?php } ?>
		<?php if($value[ifdefault]){?>
		<input type="button" value="默认语言" class="mybutton_01" style="color:red;">
		<?php }else{ ?>
		<input type="button" value="设为默认" class="mybutton_01" onclick="qgurl('admin.php?file=language&act=setdefault&id=<?php echo $value[id];?>')">
		<?php } ?>
		<?php echo $value[name];?>
		<span class="clue_on">[SN:<?php echo $value[sign];?>] [ID:<?php echo $value[id];?>]</span>
	</td>
</tr>
</table>
</div>
<?php } ?>
<script type="text/javascript">
function qg_modify(id)
{
	var url = "admin.php?file=language&act=modify&id=" + id;
	qgurl(url);
}
function qg_status(id)
{
	if(!id || id == 0)
	{
		alert("操作非法！");
		return false;
	}
	qgurl("admin.php?file=language&act=status&id="+id);
}
function qg_delete(id)
{
	question = confirm("确认删除该语言吗？如果语言正在使用中，请先停用！\n\n如果没有必要的话，请不要使用删除功能！停用语言包就成了！\n\n特别说明，删除后无法恢复！");
	if (question != "0")
	{
		qgurl("admin.php?file=language&act=delete&id="+id);
	}
}
</script>
<?php }elseif($sysAct == "modify"){ ?>
<div class="table2">
	&nbsp;<a href="admin.php?file=index">系统首页</a>
	&raquo; <a href="admin.php?file=language&act=list">语言包管理</a>
	&raquo; 编辑语言包
	<input type="button" value="语言包管理" onclick="qgurl('admin.php?file=language&act=list')">
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<form method="post" action="admin.php?file=language&act=modifyok&id=<?php echo $id;?>" onsubmit="return add_msg();">
<tr>
	<td class="left">名称：</td>
	<td class="right">
		<input type="text" name="name" id="name" value="<?php echo $rs[name];?>">
		<span class="clue_on">[填写名称，可以是任何语言，但建议不要使用特殊符号]</span>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">唯一标识：</td>
	<td class="right">
		<input type="text" name="sign" id="sign" value="<?php echo $rs[sign];?>" disabled>
		<span class="clue_on">[编辑状态下不允许修改]</span>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">状态：</td>
	<td class="right">
		<table cellpadding="1" cellspacing="0">
		<tr>
			<td><input type="radio" name="status" id="status_1" value="1"<?php if($rs[ifuse]){?> checked<?php } ?>></td>
			<td>使用</td>
			<td><input type="radio" name="status" id="status_0" value="0"<?php if(!$rs[ifuse]){?> checked<?php } ?>></td>
			<td>停用</td>
			<td><span class="clue_on">[选择停用状态，当前语言将无法创建站点]</span></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">字段及内容：</td>
	<td class="right clue_on">一行一个字段。每一个字段用 {,} 分开，左边为变量名，右边为对应的内容。</td>
</tr>
</table>
</div>
<table width="100%">
<tr>
	<td><textarea style="width:500px;height:300px;" name="content" id="content"><?php echo $rs[langc];?></textarea></td>
</tr>
</table>

<div class="table">
<table width="100%">
<tr>
	<td class="left">&nbsp;</td>
	<td class="right"><input type="submit" id="creat_button" class="mybutton_01" value="更新语言包"> &nbsp; <span id="show_step" style="color:red;"></span></td>
</tr>
</form>
</table>
</div>

<script type="text/javascript">
function add_msg(msg)
{
	var name = $("name").value;
	if(!name)
	{
		alert("语言名称不允许为空");
		return false;
	}
	$("show_step").innerHTML = "<img src='admin/tpl/images/loading.gif' border='0' align='absmiddle'> 正在保存数据，如果网页没有动静请刷新...";
	$("creat_button").disabled = true;
}
</script>
<?php } ?>

<?php QG_C_TEMPLATE::p("foot","","0");?>