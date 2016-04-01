<?php
#[引入无限级分类]
require_once("class/unlimited_category.class.php");
$CT = new Category();
$r_url = "admin.php?file=form";
#[信息录入]


if($sysAct == "add")
{
	if($cateid)
	{
		$rs = $DB->qgGetOne("SELECT sysgroupid FROM ".$prefix."category WHERE id='".$cateid."' AND language='".$language."'");
		if(!$rs)
		{
			Error("分类ID不正确！","admin.php?file=sysgroup&act=list");
		}
		$sysgroupid = $rs["sysgroupid"];
	}
	#[判断权限]
	if($_SESSION["admin"]["typer"] != "system" && !$QG_AP["msg_".$sysgroupid])
	{
		Error("对不起，您没有权限操作当前功能","admin.php?file=index");
	}
	$blist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='base' AND enable=1 ORDER BY created ASC");
	$advancedlist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='advanced' AND enable=1 ORDER BY created ASC");

	Foot("form.add.qg");
	
}elseif($sysAct == 'addOK'){
	
	$sql = "INSERT INTO form_infos(form_title,show_title,description,sure_options,sure_content,label_position,width,button_name,button_align) VALUES('$_POST[form_title]','$_POST[show_title]','$_POST[description]','$_POST[sure_options]','$_POST[sure_content]','$_POST[label_position]','$_POST[width]','$_POST[button_name]','$_POST[button_align]')";
	$DB->qgInsert($sql);
	$info_id = $DB->qgInsertID($sql);
	$SQL = "INSERT INTO sys_form_lists(admin_id,category,form_info_id,enable,created) VALUES('".$_SESSION['admin']['id']."','".$_POST['cateid']."','$info_id','$_POST[enable]','".date('Y-m-d H:i:s',time())."')";
	$DB->qgInsert($SQL);
	$fid = $DB->qgInsertID($SQL);
	
	$field_count = $_POST['field_count'];
	if($_POST['form']){
		$list = $_POST['form'];
		foreach($list AS $k=>$v){
			$data_ary = array(
				'form_id' => $fid,
				'field_name' => $v['field_label'],
			);
			foreach($v AS $key=>$value){
				$data_ary[$key] = $value;
			}
			//序列化radio,checkbox选项
			if($data_ary['field_type']=='radio'){
				$data_ary['multiple_choice'] = serialize($data_ary['radio']);
				unset($data_ary['radio']);
			}elseif($data_ary['field_type']=='checkbox'){
				$data_ary['checkbox_choice'] = serialize($data_ary['checkbox']);
				$data_ary['checkbox_choice_checked'] = serialize($data_ary['checkbox_choice_checked']);
				unset($data_ary['checkbox']);
			}elseif($data_ary['field_type']=='select'){
				$data_ary['dropdown_choice'] = serialize($data_ary['select']);
				unset($data_ary['select']);
			}
			$data_key = implode(',',array_keys($data_ary));
			$a = '';
			$data_value = '';
			foreach($data_ary AS $v1){
				$data_value .= $a."'".$v1."'";
				$a = ',';
			}
			$sql = "INSERT INTO sys_form_fields($data_key) VALUES($data_value)";
			$DB->qgInsert($sql);
		}
	}
	if($fid > 0){
		Error('添加成功','admin.php?file=category&act=list&sysgroupid=4');
	}else{
		Error('添加失败','admin.php?file=category&act=list&sysgroupid=4');
	}	
}elseif($sysAct == 'modify'){
	
	$formMsg = $DB->qgGetOne("SELECT A.*,B.form_title,B.show_title,B.description,B.sure_options,B.sure_content,B.label_position,B.width,B.button_name,B.button_align FROM sys_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=$id");
	
	$blist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='base' AND enable=1 ORDER BY created ASC");
	$advancedlist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='advanced' AND enable=1 ORDER BY created ASC");
	$fieldlist = $DB->qgGetAll("SELECT * FROM sys_form_fields WHERE form_id=$id ORDER BY field_list ASC");
	$count = count($fieldlist);
	//var_dump($fieldlist);exit;
	$contentStr = '';
	$configStr = '';
	$contentStr .= getUserContentString($fieldlist);
	$configStr = getUserContentConfig($fieldlist);
	Foot("form.modify.qg");
	
}elseif($act == 'modifyOK'){
	
	$DB->qgQuery('UPDATE sys_form_lists SET enable='.$_POST['enable'].' WHERE id='.$id);
	
	if(!isset($_POST['show_title'])){
		$_POST['show_title'] = 0;
	}
	$sql = "UPDATE form_infos SET form_title='$_POST[form_title]',show_title='$_POST[show_title]',description='$_POST[description]',sure_options='$_POST[sure_options]',sure_content='$_POST[sure_content]',label_position='$_POST[label_position]',width='$_POST[width]',button_name='$_POST[button_name]',button_align='$_POST[button_align]' WHERE id=$_POST[form_info_id]";
	$DB->qgQuery($sql);
	
	//删除原先字段信息
	$DB->qgQuery('DELETE FROM sys_form_fields WHERE form_id='.$id);
	$field_count = $_POST['field_count'];
	if($_POST['form']){
		$list = $_POST['form'];
		foreach($list AS $k=>$v){
			$data_ary = array(
				'form_id' => $id,
				'field_name' => $v['field_label'],
			);
			foreach($v AS $key=>$value){
				$data_ary[$key] = $value;
			}
			//序列化radio,checkbox选项
			if($data_ary['field_type']=='radio'){
				$data_ary['multiple_choice'] = serialize($data_ary['radio']);
				unset($data_ary['radio']);
			}elseif($data_ary['field_type']=='checkbox'){
				$data_ary['checkbox_choice'] = serialize($data_ary['checkbox']);
				$data_ary['checkbox_choice_checked'] = serialize($data_ary['checkbox_choice_checked']);
				unset($data_ary['checkbox']);
			}elseif($data_ary['field_type']=='select'){
				$data_ary['dropdown_choice'] = serialize($data_ary['select']);
				unset($data_ary['select']);
			}
			$data_key = implode(',',array_keys($data_ary));
			$a = '';
			$data_value = '';
			foreach($data_ary AS $v1){
				$data_value .= $a."'".$v1."'";
				$a = ',';
			}
			$sql = "INSERT INTO sys_form_fields($data_key) VALUES($data_value)";
			$DB->qgInsert($sql);
		}
	}
	Error('添加成功','admin.php?file=category&act=list&sysgroupid=4');
	
}elseif($sysAct == "plset"){
	$cateid = intval($cateid);
	$sysgroupid = intval($sysgroupid);
	#[判断权限]
	if($_SESSION["admin"]["typer"] != "system" && !$QG_AP["msg_".$sysgroupid])
	{
		Error("对不起，您没有权限操作当前功能","admin.php?file=index");
	}
	$myidlist = $STR->safe($idlist);#[获取IDlist]
	if(!$myidlist)
	{
		Error("信息操作不正确","admin.php?file=form&act=list&sysgroupid=".$sysgroupid);
	}
	$qgtype = $STR->safe($qgtype);
	if($qgtype == "delete")
	{
		$idarray = explode(",",$myidlist);
		foreach($idarray AS $key=>$value)
		{
			$value = intval($value);
			if($value)
			{
				$DB->qgQuery("DELETE FROM sys_form_lists WHERE id='".$value."'");#[删除主题]
				$DB->qgQuery("DELETE FROM sys_form_fields WHERE form_id='".$value."'");#[删除内容]
			}
		}
		Error("批量删模板完成！","admin.php?file=form&act=list&sysgroupid=".$sysgroupid."&cateid=".$cateid);
	}
	
}else{
	
	$sysgroupid = intval($sysgroupid);
	if(!$sysgroupid)
	{
		Error("操作非法","admin.php?file=sysgroup&act=list");
	}
	#[判断权限]
	if($_SESSION["admin"]["typer"] != "system" && !$QG_AP["msg_".$sysgroupid])
	{
		Error("对不起，您没有权限操作当前功能","admin.php?file=index");
	}
	#[显示系统组名称]
	$sql = "SELECT groupname FROM ".$prefix."sysgroup WHERE id='".$sysgroupid."'";
	$rs = $DB->qgGetOne($sql);
	if(!$rs)
	{
		Error("找不到相关系统组","admin.php?file=sysgroup&act=list");
	}
	$groupname = $rs["groupname"];

	#[根据系统组显示名称]
	$sql = "SELECT id,catename,rootid,parentid FROM ".$prefix."category WHERE sysgroupid='".$sysgroupid."' AND language='".$language."'";
	$catelist = $DB->qgGetAll($sql);
	if(!$catelist || !is_array($catelist) || count($catelist)<1)
	{
		Error("暂无分类，请先添加分类....",$r_url."&act=add&sysgroupid=".$sysgroupid);
	}
	#[得到临时分类组合，基于分类ID]
	foreach($catelist AS $key=>$value)
	{
		$cateid_array[$value["id"]] = $value["id"];
		$tmp_catename[$value["id"]] = $value["catename"];
	}
	$catelist = $CT->arraySet($catelist,0);#[这里的catelist仅用于显示select框]
	#[设置可选]
	$cateid = intval($cateid);
	#[得到cateid_array]
	if($cateid)
	{
		$cateid_array = array($cateid=>$cateid);
		$cateid_array = get_son_id_array($cateid,$catelist,$cateid_array);
	}
	if(count($cateid_array)<1)
	{
		Error("操作有错误","admin.php?file=sysgroup&act=list");
	}
	$page_url = $r_url."&act=list&sysgroupid=".$sysgroupid."&cateid=".$cateid;
	$condition = "WHERE m.category=c.id AND c.language='".$language."'";
	$condition .= " AND m.category IN(".implode(",",$cateid_array).")";
	$rs_cate = array();
	$condition .= " AND c.sysgroupid='".$sysgroupid."'";

	$psize = 30;
	$pageid = intval($pageid);
	$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
	#[获取个数]
	$sql = "SELECT count(m.id) FROM sys_form_lists AS m,".$prefix."category AS c ".$condition;
	$msg_count = $DB->qg_count($sql);
	$pagelist = page($page_url,$msg_count,$psize,$pageid);#[获取页数信息]
	#[加条件]
	$sql = "SELECT m.id FROM sys_form_lists AS m,".$prefix."category AS c ".$condition." ORDER BY m.id DESC LIMIT ".$offset.",1";
	$rs_id = $DB->qgGetOne($sql);
	$get_id = $rs_id["id"];
	$condition .= " AND m.id<='".$get_id."'";

	$sql = "SELECT m.*,c.catename FROM sys_form_lists AS m,".$prefix."category AS c ".$condition." ORDER BY m.id DESC LIMIT ".$psize;
	$rslist = $DB->qgGetAll($sql,true);
	if($dbType=='sqlite')
	{
		$rslist=reSetRs($rslist);
	}
	foreach($rslist AS $key=>$value)
	{
		$formInfo = $DB->qgGetOne("SELECT * FROM form_infos WHERE id=".$value['form_info_id']);
		$value['info'] = $formInfo;
		$value["v_catename"] = $STR->cut($value["catename"],8,"");
		$msglist[] = $value;
	}
	Foot("form.list.qg");
	
}

function get_son_id_array($id,$array,$myid=array())
{
	foreach($array AS $key=>$value)
	{
		if($value["parentid"] == $id)
		{
			$myid[$value["id"]] = $value["id"];
			get_son_id_array($value["id"],$array,$myid);
		}
	}
	return $myid;
}

?>