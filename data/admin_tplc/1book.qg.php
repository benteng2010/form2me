<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
<?php QG_C_TEMPLATE::p("right.css","","0");?>
<?php QG_C_TEMPLATE::p("right.head","","0");?>

<!-- 留言本 -->
<?php if($sysAct == "view"){?>
<div class="table2">
	&nbsp;<a href="admin.php?file=index">系统首页</a>
	&raquo; <a href="admin.php?file=book&act=list">留言列表</a>
	&raquo; <?php echo $rs[subject];?> &nbsp;〔第一个编辑框是留言信息，第二个编辑框是回复信息〕
	<input type="button" value="留言列表" onclick="qgurl('admin.php?file=book&act=list')">
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<form name="qgform" method="post" action="admin.php?file=book&act=viewok&id=<?php echo $id;?>">
<tr>
	<td class="left">审核：</td>
	<td class="right">
		<table cellpadding="1" cellspacing="0">
		<tr>
			<td><input type="radio" name="ifcheck" value="0"<?php if(!$rs[ifcheck]){?> checked<?php } ?>></td>
			<td>未审核</td>
			<td><input type="radio" name="ifcheck" value="1"<?php if($rs[ifcheck]){?> checked<?php } ?>></td>
			<td>已审核</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">主题：<span style="color:red;">*</span></td>
	<td class="right">
		<span><input type="text" name="subject" id="subject" class="long_input" value="<?php echo $rs[subject];?>"></span>
		<span class="clue_on">[发布时间：<?php echo date("Y-m-d H:i:s",$rs[postdate]);?>]</span>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">邮箱：</td>
	<td class="right">
		<table cellpadding="1" cellspacing="0">
		<tr>
			<td><input type="text" name="email" id="email" value="<?php echo $rs[email];?>"></td>
			<td><input type="button" value="发送邮件" onclick="qgurl('admin.php?file=email&act=send&email=<?php echo rawurlencode($rs[email]);?>')"></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">发布人：<span style="color:red;">*</span></td>
	<td class="right"><input type="text" name="qguser" id="qguser" value="<?php echo $rs[user];?>"></td>
</tr>
</table>
</div>


<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left">回复时间：</td>
	<td class="right"><input type="text" name="replydate" id="replydate" value="<?php echo date('Y-m-d H:i:s',$system_time);?>"> <span class="clue_on"> [一般不用修改回复时间]</span></td>
</tr>
</table>
</div>

<?php $rs[content] = preg_replace("/<(.*?)>/is","",$rs[content]);;?>
<table width="100%" cellspacing="0" cellpadding="1">
<tr>
	<td><textarea name="content" style="width:100%;height:150px;"><?php echo $rs[content];?></textarea></td>
</tr>
</table>

<div><?php echo $fckeditor;?></div>

<div class="table">
<table width="100%">
<tr>
	<td class="left"></td>
	<td class="right"><input type="submit" class="mybutton_01" value="提 交"> &nbsp; <span id="show_step" style="color:red;"></span></td>
</tr>
</table>
</div>

</form>


<?php }else{ ?>
<table width="100%">
<tr>
	<td class="qg_notice" style="text-align:left;">
		<a href="admin.php?file=index">系统首页</a>
		&raquo; 留言列表
	</td>
</tr>
</table>

<div class="table" style="border-bottom:1px #D4D4D4 solid;">
<table cellpadding="1" cellspacing="0">
<tr>
	<form method="post" action="admin.php?file=book&act=list">
	<td>关键字：</td>
	<td><input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>"></td>
	<td>
		<select name="stype" id="stype">
		<option value="subject"<?php if($stype == "subject"){?> selected<?php } ?>>主题</option>
		<option value="user"<?php if($stype == "user"){?> selected<?php } ?>>会员</option>
		<option value="email"<?php if($stype == "email"){?> selected<?php } ?>>邮箱</option>
		</select>
	</td>
	<td>
		<select name="ifcheck" id="ifcheck">
		<option value="0"<?php if($ifcheck == "0" || !$ifcheck){?> selected<?php } ?>>全部</option>
		<option value="1"<?php if($ifcheck == 1){?> selected<?php } ?>>已审核</option>
		<option value="2"<?php if($ifcheck == 2){?> selected<?php } ?>>未审核</option>
		</select>
	</td>
	<td><input type="submit" value="搜索"></td>
	</form>
</tr>
</table>
</div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr class="table table2">
	<td height="23px" class="msg_checkbox b_b">&nbsp;</td>
	<td class="msg_subject_id b_b">主题ID</td>
	<td class="msg_subject b_b">主题</td>
	<td class="msg_postdate b_b">发布时间</td>
	<td class="msg_postdate b_b">操作</td>
</tr>
<?php $_i=0;$booklist=(is_array($booklist))?$booklist:array();foreach($booklist AS  $key=>$value){$_i++; ?>
<tr class="m_out" onmouseover="this.className='m_over'" onmouseout="this.className='m_out'">
	<td height="25px" class="b_b"><input type="checkbox" name="qg_id[]" value="<?php echo $value[id];?>"></td>
	<td align="center" class="b_b"><?php echo $value[id];?></td>
	<td class="b_b">
		<?php if(!$value[ifcheck]){?><span style="color:red;">[未审核] </span><?php } ?>
		<?php echo $value[subject];?>
	</td>
	<td align="center" class="b_b"><?php echo $value[postdate];?></td>
	<td align="center" class="b_b">
		<input type="button" value="查看/回复" class="mybutton_01" onclick="qg_view(<?php echo $value[id];?>)">
		<input type="button" value="删除" class="mybutton_01" onclick="qg_delete(<?php echo $value[id];?>)">
	</td>
</tr>
<?php } ?>
</table>

<div class="table">
<table width="100%">
<tr>
	<td align="left">
		<input type="button" value="审核" onclick="qg_pl('check')">
		<input type="button" value="取消审核" onclick="qg_pl('dcheck')">
		<input type="button" value="删除" onclick="qg_pl('delete')">
		<span class="clue_on">[请勾选主题]</span>
	</td>
	<td align="right"><?php echo $pagelist;?></td>
</tr>
</table>
</div>
<script type="text/javascript">
function qg_view(id)
{
	qgurl("admin.php?file=book&act=view&id="+id);
}
function qg_delete(id)
{
	//判断是否删除
	question = confirm("确认删除该信息吗？特别说明，删除后无法恢复！");
	if (question != "0")
	{
		qgurl("admin.php?file=book&act=delete&id="+id);
	}
}
function qg_pl(qgtype)
{
	var idarray = new Array();//定义一个数组
	var cv = document.getElementsByTagName("input");
	var m = 0;
	for(var i=0; i<cv.length; i++)
	{
		if(cv[i].type.toLowerCase() == "checkbox")
		{
			if(cv[i].checked)
			{
				idarray[m] = cv[i].value;
				m++;
			}
		}
	}
	var id = idarray.join(",");
	if(!id || id == "0")
	{
		alert("没有勾选要操作的主题！");
		return false;
	}
	var url;
	url = "admin.php?file=book&act=plset&idlist=" + id + "&qgtype=" + qgtype;
	if(qgtype == "delete")
	{
		question = confirm("确认删除该信息吗？特别说明，删除后无法恢复！");
		if (question != "0")
		{
			qgurl(url);
		}
	}
	else
	{
		qgurl(url);
	}
}
</script>

<?php } ?>

<?php QG_C_TEMPLATE::p("foot.sys","","0");?>