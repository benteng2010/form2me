<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
<?php QG_C_TEMPLATE::p("right.css","","0");?>
<?php QG_C_TEMPLATE::p("right.head","","0");?>

<!-- 信息列表页 -->
<div class="table2">
	&nbsp;<a href="admin.php?file=index">系统首页</a>
	&raquo; <a href="admin.php?file=msg&act=list&sysgroupid=<?php echo $sysgroupid;?>"><?php echo $groupname;?></a>
	&raquo; 列表
	<input type="button" value="添加新<?php echo $groupname;?>" onclick="qgurl('<?php echo $r_url;?>&act=add&sysgroupid=<?php echo $sysgroupid;?>')">
	<input type="button" value="管理<?php echo $groupname;?>分类" onclick="qgurl('admin.php?file=category&act=list&sysgroupid=<?php echo $sysgroupid;?>')">
</div>
<script src="admin/tpl/images/date.js"></script>
<div class="table">
	<table cellpadding="1" cellspacing="0">
	<form method="post" action="admin.php?file=msg&act=list&sysgroupid=<?php echo $sysgroupid;?>">
	<tr>
		<td>分类：</td>
		<td>
			<select name="cateid" id="cateid">
			<option value="0">选择分类...</option>
			<?php $_i=0;$catelist=(is_array($catelist))?$catelist:array();foreach($catelist AS  $key=>$value){$_i++; ?>
			<option value="<?php echo $value[id];?>"<?php if($cateid == $value[id]){?> selected<?php } ?>><?php echo $value[space];?><?php echo $value[catename];?></option>
			<?php } ?>
			</select>
		</td>
		<td>&nbsp;关键字：</td>
		<td><input type="text" name="keywords" id="keywords" value="<?php echo $keywords;?>"></td>
		<td>&nbsp;时间段：</td>
		<td><input type="text" name="s_time" id="s_time" onClick="javascript:ShowCalendar('s_time')" value="<?php echo $s_time;?>" class="short_input"></td>
		<td>-</td>
		<td><input type="text" name="e_time" id="e_time" onClick="javascript:ShowCalendar('e_time')" value="<?php echo $e_time;?>" class="short_input"></td>
		<td>
			<input type="submit" value="搜索" class="mybutton_01">
		</td>
		</form>
	</tr>
	</table>
</div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr class="table table2">
	<td height="23px" class="msg_checkbox b_b">&nbsp;</td>
	<td class="msg_subject_id b_b">主题ID</td>
	<td class="msg_category b_b">分类</td>
	<td class="msg_subject b_b">主题</td>
	<td class="msg_hits b_b">点击率</td>
	<td class="msg_postdate b_b">发布时间</td>
	<td class="msg_act b_b">操作</td>
</tr>
<?php $_i=0;$msglist=(is_array($msglist))?$msglist:array();foreach($msglist AS  $key=>$value){$_i++; ?>
<tr class="m_out" onmouseover="this.className='m_over'" onmouseout="this.className='m_out'">
	<td height="25px" class="b_b"><input type="checkbox" name="qg_id[]" value="<?php echo $value[id];?>"></td>
	<td align="center" class="b_b"><?php echo $value[id];?></td>
	<td align="center" class="b_b"><a href="admin.php?file=msg&act=list&cateid=<?php echo $value[cateid];?>" title="<?php echo $value[catename];?>"><?php echo $value[v_catename];?></a></td>
	<td class="b_b">
		<?php if(!$value[ifcheck]){?><span style="color:red;">[未审核] </span><?php } ?>
		<?php echo $value[subject];?>
		<?php if($value[thumb]){?>
		<img src="admin/tpl/images/thumb.gif" border="0" align="absmiddle" style="cursor:pointer;" onclick="qgopen('admin.php?file=open.viewpic&id=<?php echo $value[thumb];?>&type=thumb',400)">
		<?php } ?>
		<?php if($value[istop]){?><span style="color:red;">[顶]</span><?php } ?>
		<?php if($value[isvouch]){?><span style="color:darkblue;">[荐]</span><?php } ?>
		<?php if($value[isbest]){?><span style="color:darkred;;">[精]</span><?php } ?>
	</td>
	<td align="center" class="b_b"><?php echo $value[hits];?></td>
	<td align="center" class="b_b"><?php echo $value[postdate];?></td>
	<td align="center" class="b_b"><input type="button" value="编辑" class="mybutton_01" onclick="qg_modify(<?php echo $value[id];?>)"></td>
</tr>
<?php } ?>
</table>

<div class="table">
<input type="button" value="全选" onclick="select_all()">
<input type="button" value="反选" onclick="revCheck()">
<input type="button" value="全不选" onclick="selectNone()">
<input type="button" value="排序提前" onclick="qg_pl('orderdate')">
<input type="button" value="置顶" onclick="qg_pl('top')">
<input type="button" value="推荐" onclick="qg_pl('vouch')">
<input type="button" value="精华" onclick="qg_pl('best')">
<input type="button" value="审核" onclick="qg_pl('check')">
<input type="button" value="取消置顶" onclick="qg_pl('dtop')">
<input type="button" value="取消推荐" onclick="qg_pl('dvouch')">
<input type="button" value="取消精华" onclick="qg_pl('dbest')">
<input type="button" value="锁定" onclick="qg_pl('dcheck')">
<input type="button" value="批量删除" onclick="qg_pl('delete')">
</div>

<div align="right"><?php echo $pagelist;?></div>

<script type="text/javascript">
function qg_modify(id)
{
	qgurl("admin.php?file=msg&act=modify&id="+id);
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
	url = "admin.php?file=msg&act=plset&idlist=" + id + "&qgtype=" + qgtype + "&sysgroupid=<?php echo $sysgroupid;?>&cateid=<?php echo $cateid;?>";
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

<?php QG_C_TEMPLATE::p("foot","","0");?>