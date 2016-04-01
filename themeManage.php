<?php
require_once("global.php");
if(!USER_STATUS){
	Error('请先登录','login.php');
}
$userId = $_SESSION['qg_sys_user']['id'];
$controller = 'themeManage';

if($act == 'edit'){
	$themeMsg = array();
	$themelist = $DB->qgGetAll("SELECT * FROM theme_lists WHERE user_id=$userId ORDER BY created DESC");
	if(empty($themelist)){
		$list = $DB->qgGetOne("SELECT * FROM theme_lists WHERE user_id=0 AND subject='default'");
		$id = $DB->qgInsert("INSERT INTO theme_lists(user_id,subject,backgrounds,text,borders,created) VALUES($userId,'default','".$list['backgrounds']."','".$list['text']."','".$list['borders']."','".date('Y-m-d H:i:s',time())."')");
		$themeMsg = $list;
		$themeMsg['backgrounds'] = unserialize($themeMsg['backgrounds']);
		//页面属性转换成json格式存入表单
		foreach($themeMsg['backgrounds'] AS $key=>$value){
			$themeMsg['backgrounds'][$key.'1'] = json_encode($value);
		}
		$themeMsg['text'] = unserialize($themeMsg['text']);
		foreach($themeMsg['text'] AS $key=>$value){
			$themeMsg['text'][$key.'1'] = json_encode($value);
		}
		$themeMsg['borders'] = unserialize($themeMsg['borders']);
		foreach($themeMsg['borders'] AS $key=>$value){
			$themeMsg['borders'][$key.'1'] = json_encode($value);
		}
		$themeMsg['button'] = unserialize($themeMsg['button']);
		foreach($themeMsg['button'] AS $key=>$value){
			$themeMsg['button'][$key.'1'] = json_encode($value);
		}
		
		foreach($themelist AS $key=>$value){
			$options[$value['id']] = $value['subject'];
		}
	}elseif($id=='new'){
		$userMsg = $DB->qgGetOne("SELECT * FROM f_user WHERE id=$userId");
		if($userMsg['user_group']=='vistor' && $userMsg['theme_num']>=1){
			Error('您所在的用户组只能制作1套主题！','themeManage.php?act=edit');
		}
		$id = 0;
	}else{
		if($id){
			$themeMsg = $DB->qgGetOne("SELECT * FROM theme_lists WHERE id=$id");
		}else{
			$themeMsg = $themelist[0];
			$id = $themeMsg['id'];
		}
		$themeMsg['backgrounds'] = unserialize($themeMsg['backgrounds']);
		//页面属性转换成json格式存入表单
		foreach($themeMsg['backgrounds'] AS $key=>$value){
			$themeMsg['backgrounds'][$key.'1'] = json_encode($value);
		}
		$themeMsg['text'] = unserialize($themeMsg['text']);
		foreach($themeMsg['text'] AS $key=>$value){
			$themeMsg['text'][$key.'1'] = json_encode($value);
		}
		$themeMsg['borders'] = unserialize($themeMsg['borders']);
		foreach($themeMsg['borders'] AS $key=>$value){
			$themeMsg['borders'][$key.'1'] = json_encode($value);
		}
		
		$themeMsg['button'] = unserialize($themeMsg['button']);
		if(!empty($themeMsg['button'])){
			foreach($themeMsg['button'] AS $key=>$value){
				$themeMsg['button'][$key.'1'] = json_encode($value);
			}
		}
		//var_dump($themeMsg['button']);
		foreach($themelist AS $key=>$value){
			$options[$value['id']] = $value['subject'];
		}
	}
	$list = $DB->qgGetAll("SELECT * FROM colors ORDER BY id ASC");
	$tpl_list = 'theme_edit';
	
}elseif($act == 'editOK'){
	
	$bg = array(
		'wallpaper' => json_decode(str_replace("\\","",$_POST['bg_wallpaper']),true),
		'header' => json_decode(str_replace("\\","",$_POST['bg_header']),true),
		'form' => json_decode(str_replace("\\","",$_POST['bg_form']),true),
		'field' => json_decode(str_replace("\\","",$_POST['bg_field']),true),
		'highlight' => json_decode(str_replace("\\","",$_POST['bg_highlight']),true),
		'instruction' => json_decode(str_replace("\\","",$_POST['bg_instruction']),true)
	);
	$text = array(
		'title' => json_decode(str_replace("\\","",$_POST['text_title']),true),
		'description' => json_decode(str_replace("\\","",$_POST['text_description']),true),
		'field_title' => json_decode(str_replace("\\","",$_POST['text_fieldtitle']),true),
		'field_text' => json_decode(str_replace("\\","",$_POST['text_fieldtext']),true),
		'instruction' => json_decode(str_replace("\\","",$_POST['text_instruction']),true)
	);
	
	$border = array(
		'form' => json_decode(str_replace("\\","",$_POST['border_form']),true),
	);
	
	$button = array(
		'style' => json_decode(str_replace("\\","",$_POST['button_style']),true)
	);
	if($_POST['theme_id'] == 0){
		$sql = "INSERT INTO theme_lists(user_id,subject,backgrounds,text,borders,button) VALUES('$userId','".$_POST['subject']."','".serialize($bg)."','".serialize($text)."','".serialize($border)."','".serialize($button)."')";
		$DB->qgInsert($sql);
	}else{
		$id = $_POST['theme_id'];
		$sql = "UPDATE theme_lists SET backgrounds='".serialize($bg)."',text='".serialize($text)."',borders='".serialize($border)."',button='".serialize($button)."' WHERE id=$id";
		$DB->qgQuery($sql);
	}
	Error('保存成功','themeManage.php?act=edit&id='.$id);
	
}elseif($act == 'del'){
	
	$DB->qgQuery("DELETE FROM theme_lists WHERE id=$id");
	Error('删除成功','themeManage.php?act=edit');
	
}elseif($act == 'rename'){
	
	$id = $_POST['themeId'];
	$sql = "UPDATE theme_lists SET subject='".$_POST['theme_name_rename']."' WHERE id=$id";
	if($DB->qgQuery($sql)){
		$DB->qgQuery("UPDATE user_form_lists SET form_style_id=0 WHERE form_style_id=$id");
		Error('保存成功','themeManage.php?act=edit&id='.$id);
	}else{
		Error('保存失败','themeManage.php?act=edit&id='.$id);
	}
}

HEAD();
FOOT($tpl_list);

?>