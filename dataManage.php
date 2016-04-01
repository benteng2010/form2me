<?php
require_once('global.php');
if(!USER_STATUS){
	Error('请先登录','login.php');
}
$userId = $_SESSION['qg_sys_user']['id'];

if($act == 'setcolumns'){
	
	$list = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=$fid ORDER BY field_list ASC");
	echo json_encode($list);
	exit;
	
}elseif($act == 'getsubmiter'){
	
	$msg = $DB->qgGetOne("SELECT * FROM user_form_datas WHERE id=$id");
	$clist = $DB->qgGetAll("SELECT * FROM form_data_comments WHERE data_id=$id ORDER BY created DESC LIMIT 5");
	if(!empty($clist)){
		$msg['clist'] = $clist;
	}else{
		$msg['clist'] = '';
	}
	$num = $DB->qg_count("SELECT count(*) FROM form_data_comments WHERE data_id=$id");
	$msg['num'] = $num;
	echo json_encode($msg);
	exit;	
	
}elseif($act == 'getFormContent'){

	$formMsg = $DB->qgGetOne("SELECT * FROM user_form_lists WHERE id=$fid");
	$content =fieldCreate($fid,$formMsg['form_title'],'tpl_1.html');
	echo $content;
	exit;

}elseif($act == 'add'){

	$data = $_POST;
	unset($data['authcode_field'],$data['form_id'],$data['_method']);
	$dataCode = serialize($data);
	$sql = "INSERT INTO user_form_datas(form_id,form_data,ip,created) VALUES('".$_POST['form_id']."','".$dataCode."','".getIP()."','".date('Y-m-d H:i:s')."')";
	if($DB->qgInsert($sql)){
		Error('提交成功','dataManage.php?fid='.$_POST['form_id']);
	}else{
		Error('提交失败','dataManage.php?fid='.$_POST['form_id']);
	}

}elseif($act == 'modify'){

	$data = $_POST;
	unset($data['authcode_field'],$data['form_id'],$data['_method']);
	$dataCode = serialize($data);
	$sql = "UPDATE user_form_datas SET form_data='".$dataCode."' WHERE id=$id";
	if($DB->qgQuery($sql)){
		Error('提交成功','dataManage.php?fid='.$_POST['form_id']);
	}else{
		Error('提交失败','dataManage.php?fid='.$_POST['form_id']);
	}

}elseif($act == 'dataPrint'){

	$msg = $DB->qgGetOne("SELECT A.*,B.form_info_id FROM user_form_datas AS A LEFT JOIN user_form_lists AS B ON A.form_id=B.id WHERE A.id=$id");
	$forminfo = $DB->qgGetOne("SELECT form_title FROM form_infos WHERE id=".$msg['form_info_id']);
	$list = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=".$msg['form_id']." ORDER BY field_list ASC");
	HEAD();
	FOOT('form_print');

}elseif($act == 'deleteOne'){

	$DB->qgQuery("DELETE FROM user_form_datas WHERE id=$id");
	$DB->qgQuery("DELETE FROM form_data_comments WHERE data_id=$id");
	echo 1;
	exit;

}elseif($act == 'dataEmail'){

	$id = $_POST['id'];
	$msg = $DB->qgGetOne("SELECT A.*,B.form_info_id FROM user_form_datas AS A LEFT JOIN user_form_lists AS B ON A.form_id=B.id WHERE A.id=$id");
	$forminfo = $DB->qgGetOne("SELECT * FROM form_infos WHERE id=".$msg['form_info_id']);
	$list = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=".$msg['form_id']." ORDER BY field_list ASC");
	$data = unserialize($msg['form_data']);
	$content = '<div id="contentDiv" class="" style="position:relative;font-size:14px;height:auto;padding:15px 15px 10px 15px;*padding:15px 15px 0 15px;overflow:visible;line-height:170%;min-height:100px;_height:100px;">'
	.'<div style="font-size: 14px; padding: 0pt; height: auto; font-family:\'lucida Grande\',Verdana; margin-right: 170px;" id="mailContentContainer"><p><b>'.$forminfo['form_title'].'</b></p><table><tbody>';
	foreach($list AS $key=>$value){
	  $content .= '<tr>'
	  .'<th>'.$value['field_name'].'：</th><td>'.(gettype($data['element_'.$key])=='array'?implode(',',$data['element_'.$key]):$data['element_'.$key]).'</td>'
	  .'</tr>';
	}
	$content .= '</tbody></table>'
	.'</div>'
	.'</div>';
	$receiver = $_POST['email'];
	SendEmail($receiver,'表单数据反馈',$content);
	Error('发送成功','dataManage.php?fid='.$fid);

}elseif($act == 'del'){

	if(!$_POST['idlist']){
		Error('地址有误','dataManage.php?fid='.$_POST['fid']);
	}else{
		foreach($_POST['idlist'] AS $value){
			$DB->qgQuery("DELETE FROM user_form_datas WHERE id=$value");
			$DB->qgQuery("DELETE FROM form_data_comments WHERE data_id=$value");
		}
		Error('删除成功','dataManage.php?fid='.$_POST['fid']);
	}

}elseif($act == 'commentSubmit'){
	$sql = "INSERT INTO form_data_comments(data_id,content,name,created) VALUES('".$_POST['data_id']."','".$_POST['comment_text']."','".$_POST['comment_name']."','".date('Y-m-d H:i:s',time())."')";
	
	if($DB->qgInsert($sql)){
		Error('提交成功','dataManage.php?fid='.$fid);
	}else{
		Error('提交失败','dataManage.php?fid='.$fid);
	}
}else{
	
	#[设定每页显示数量]
	$psize = 15;
	$pageurl = "dataManage.php?fid=".$fid;
	#[获取分页ID]
	$pageid = intval($pageid);
	if($pageid < 1)
	{
		$pageid = 1;
	}
	$offset = $pageid > 0 ? ($pageid-1)*$psize : 0;
	$sql = "SELECT count(*) AS countid FROM user_form_datas WHERE form_id=$fid";
	$listcount = $DB->qgGetOne($sql);#[获取总数]
	$msglistcount = $listcount["countid"];
	$pagelist = page($pageurl,$msglistcount,$psize,$pageid,5,'data');#[获取分页的数组
															  
	$sql = "SELECT * FROM user_form_datas WHERE form_id=$fid ORDER BY created DESC LIMIT ".$offset.",".$psize;
	$data = $DB->qgGetAll($sql);
	
	$formMsg = $DB->qgGetOne("SELECT A.*,B.form_title FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=$fid");
	$fieldlist = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=$fid ORDER BY field_list ASC");
	$clist = array();
	if(empty($data)){
		$cnum = 0;
	}else{
		$clist = $DB->qgGetAll("SELECT * FROM form_data_comments WHERE data_id=".$data[0]['id']." ORDER BY created DESC LIMIT 5");
		$cnum = count($clist);
	}
	HEAD();
	FOOT('data_page');
	
}

?>