<?php
#============================
#	Filename: list_idin.qgmod.php
#	Note	: 列表模块
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-3-25
#============================
global $FS,$DB,$prefix,$dbType;
if(!defined("QGLIST_ID") || !defined("QGLIST_IDIN"))
{
	return false;
}
if($ispic)
{
	$md5 = md5(LANGUAGE_ID."_".QGLIST_ID."_".$orderby."_".$length."_1_".$limit);
}
else
{
	$md5 = md5(LANGUAGE_ID."_".QGLIST_ID."_".$orderby."_".$length."_0_".$limit);
}
$cache_file = "data/cache/listidin_".$md5.".php";#[缓存文件]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	include_once($cache_file);
	return;
}
#[获取列表信息]
if($ispic)
{
	$sql = "SELECT m.*,c.catename,u.filename AS u_filename,u.filetype AS u_filetype,u.thumbfile AS u_thumbfile,u.markfile AS u_markfile,u.folder AS u_folder FROM ".$prefix."msg AS m,".$prefix."category AS c,".$prefix."upfiles AS u WHERE m.cateid IN(".QGLIST_IDIN.") AND m.ifcheck='1' AND m.cateid=c.id AND m.thum!='0' AND m.thumb=u.id ORDER BY ";
	$order_list = _____QGMODULE_ORDERBY($orderby,"m");
	$sql .= implode(",",$order_list);
	unset($order_list);
	$sql .= " LIMIT 0,".$limit;
	$rslist = $DB->qgGetAll($sql);
if($dbType=='sqlite')
{
	$rslist=reSetRs($rslist);
}
	unset($sql);
	if(!$rslist)
	{
		return;
	}
	$list = _____QGMODULE_CLEARUP_LIST($rslist,0,true);
	$FS->qgWrite($list,$cache_file,"list");
	unset($rslist,$cache_file);
	return $list;
}
$sql = "SELECT * FROM ".$prefix."msg WHERE cateid IN(".QGLIST_IDIN.") AND ifcheck='1' ORDER BY";
if($orderby)
{
	$sql .= " ".$orderby;
}
else
{
	$sql .= " orderdate DESC,id DESC";
}
$sql .= " LIMIT 0,".$limit;
$rslist = $DB->qgGetAll($sql);
unset($sql);
if(!$rslist)
{
	return;
}
$list = _____QGMODULE_CLEARUP_LIST($rslist,$length);
$FS->qgWrite($list,$cache_file,"list");
unset($rslist,$cache_file);
?>