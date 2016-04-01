<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?><?php QG_C_TEMPLATE::p("global_head","","0");?>
<?php QG_C_TEMPLATE::p("right.css","","0");?>
<?php QG_C_TEMPLATE::p("right.head","","0");?>

<!-- 添加新模板 -->
<div class="table2">
	&nbsp;<a href="admin.php?file=index">系统首页</a> &raquo;
	<a href="admin.php?file=tpl&act=list">风格管理</a>
	<input type="button" value="添加新风格" onclick="qgurl('admin.php?file=tpl&act=add')">
</div>

<?php $_i=0;$rslist=(is_array($rslist))?$rslist:array();foreach($rslist AS  $key=>$value){$_i++; ?>
<div class="table" onmouseover="this.className='table table1'" onmouseout="this.className='table'">
<table width="100%">
<tr>
	<td class="left"><?php echo $value[name];?></td>
	<td class="right">
		<?php if($value[isdefault]){?>
		<input type="button" value="默认使用" style="color:red;">
		<?php }else{ ?>
		<input type="button" value="设为默认" onclick="qgurl('admin.php?file=tpl&act=setdefault&id=<?php echo $value[id];?>')">
		<?php } ?>
		<input type="button" value="编辑" onclick="to_modify(<?php echo $value[id];?>)">
		<input type="button" value="删除" onclick="to_delete('<?php echo $value[id];?>','<?php echo $value[name];?>')">
	</td>
</tr>
</table>
</div>
<?php } ?>
<script type="text/javascript">
function to_modify(id)
{
	var url = "admin.php?file=tpl&act=modify&id=" + id;
	window.location.href = url;
}
function to_delete(id,name)
{
	var q = confirm("确定要删除 " + name + " 风格吗？删除后不能恢复！");
	if(q != "0")
	{
		window.location.href = "admin.php?file=tpl&act=delete&id=" + id;
	}
}
</script>

<?php QG_C_TEMPLATE::p("foot","","0");?>