<?php
require_once("global.php");
if($act!='chkauthcode' && $act!='checkauthcode' && $act!='createFormStyle'){
	if(!USER_STATUS){
		Error('请先登录','login.php');
	}
	$userId = $_SESSION['qg_sys_user']['id'];
}

$controller = 'formManage';

if($act == 'changetheme'){
	
	$fid = $_GET['fid'];
	$themeId = $_GET['themeId'];
	$DB->qgQuery('UPDATE user_form_lists SET form_style_id='.$themeId.' WHERE id='.$fid);
	echo 1;
	exit;
	
}elseif($act == 'del'){
	
	$id = $_GET['id'];
	$msg = $DB->qgGetOne("SELECT form_info_id FROM user_form_lists WHERE id=".$id);
	$DB->qgQuery('DELETE FROM user_form_lists WHERE id='.$id);
	//$DB->qgQuery('DELETE FROM form_info WHERE id='.$msg['form_info_id']);
	$DB->qgQuery("UPDATE f_user SET form_num=form_num-1 WHERE id=$userId");
	Error('删除成功','formManage.php');
	
}elseif($act == 'view'){
	$formMsg = $DB->qgGetOne("SELECT B.form_title FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$id);
	$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'
	.'<html xmlns="http://www.w3.org/1999/xhtml">'
	.'<head>'
	.'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'
	.'<title></title>'
	.'</head>';
	$content .= fieldCreate($id,$formMsg['form_title'],'tpl_2.html');
	$content .= '</html>';
	$tpl_list = 'form_view';
	
}elseif($act == 'createFormStyle'){

	$id = base64_decode($id);
	$formMsg = $DB->qgGetOne("SELECT B.backgrounds,B.text,B.borders FROM user_form_lists AS A LEFT JOIN theme_lists AS B ON A.form_style_id=B.id WHERE A.id=".$id);
	$list = $DB->qgGetOne("SELECT B.button_align,B.width FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$id);
	$bg = unserialize($formMsg['backgrounds']);
	$text = unserialize($formMsg['text']);
	$border = unserialize($formMsg['borders']);
	
	$css = ".emf-div-field input{"
	."background-color:".$bg['field']['color'].";"
	."color:".$text['field_text']['color'].";"
	."font-family:".$text['field_text']['font'].";"
	."font-style:".$text['field_text']['style'].";"
	."font-weight:".$text['field_text']['weight'].";"
	."font-size:".$text['field_text']['size']."px;"
	."}";
	
	$css .= ".emf-div-field textarea{"
	."background-color:".$bg['field']['color'].";"
	."color:".$text['field_text']['color'].";"
	."font-family:".$text['field_text']['font'].";"
	."font-style:".$text['field_text']['style'].";"
	."font-weight:".$text['field_text']['weight'].";"
	."font-size:".$text['field_text']['size']."px;"
	."}";
	
	$css .= ".emf-label-desc{"
	."font-family:".$text['field_title']['font'].";"
	."font-style:".$text['field_title']['style'].";"
	."font-weight:".$text['field_title']['weight'].";"
	."font-size:".$text['field_title']['size']."px;"
	."color:".$text['field_title']['color'].";"
	."}";
	
	$css .= ".emf-li-field{"
	."background-color:".$bg['highlight']['color'].";"
	."}";
	
	$css .= "#emf-container-wrap{"
	."background-color:".$bg['wallpaper']['color'].";"
	."}";
	
	$css .= "#emf-container{"
	."width:".($list['width']?$list['width']:'640')."px;"
	."background-color:".$bg['form']['color'].";"
	."border:".$border['form']['thickness'].'px '.$border['form']['style'].' '.$border['form']['color'].";"
	."font-size:".$text['field_title']['size']."px;"
	."}";
	
	$css .= "#emf-logo{"
	."background-color:".$bg['header']['color'].";"
	."}";
	
	$css .= "#emf-form-title{"
	."font-family:".$text['title']['font'].";"
	."font-style:".$text['title']['style'].";"
	."font-weight:".$text['title']['weight'].";"
	."font-size:".$text['title']['size']."px;"
	."color:".$text['title']['color'].";"
	."}";
	
	$css .= "#emf-li-post-button{"
	."text-align:".$list['button_align'].";"
	."}";
	
	header("Content-type: text/css");
	echo $css;
	exit;
	
	/*
	$js = "jQuery(document).ready(function(){"
	."jQuery('#url').val(window.location.href);"									   
	."jQuery('.emf-div-field > input').css({"
	."'background-color':'".$bg['field']['color']."',"
	."'color':'".$text['field_text']['color']."',"
	."'font-family':'".$text['field_text']['font']."',"
	."'font-style':'".$text['field_text']['style']."',"
	
	."'font-weight':'".$text['field_text']['weight']."',"
	."'font-size':'".$text['field_text']['size']."px'"
	."});"
	
	."jQuery('.emf-div-field > textarea').css({"
	."'background-color':'".$bg['field']['color']."',"
	."'color':'".$text['field_text']['color']."',"
	."'font-family':'".$text['field_text']['font']."',"
	."'font-style':'".$text['field_text']['style']."',"
	."'font-weight':'".$text['field_text']['weight']."',"
	."'font-size':'".$text['field_text']['size']."px'"
	."});"
	
	."jQuery('.emf-label-desc').css({"
	."'font-family':'".$text['field_title']['font']."',"
	."'font-style':'".$text['field_title']['style']."',"
	."'font-weight':'".$text['field_title']['weight']."',"
	."'font-size':'".$text['field_title']['size']."px',"
	."'color':'".$text['field_title']['color']."'"
	."});"
	
	."jQuery('.emf-li-field').css({"
	."'background-color':'".$bg['highlight']['color']."'"
	."});"
	
	."jQuery('#emf-container-wrap').css({"
	."'background-color':'".$bg['wallpaper']['color']."'"
	."});"
	
	."jQuery('#emf-container').css({"
	."'width':'".($list['width']?$list['width']:'640')."px',"
	."'background-color':'".$bg['form']['color']."',"
	."'border':'".$border['form']['thickness'].'px '.$border['form']['style'].' '.$border['form']['color']."',"
	."'font-size':'".$text['field_title']['size']."px',"
	."});"
	
	."jQuery('#emf-logo').css({"
	."'background-color':'".$bg['header']['color']."'"
	."});"
	
	."jQuery('#emf-form-title').css({"
	."'font-family':'".$text['title']['font']."',"
	."'font-style':'".$text['title']['style']."',"
	."'font-weight':'".$text['title']['weight']."',"
	."'font-size':'".$text['title']['size']."px',"
	."'color':'".$text['title']['color']."'"
	."});"
	
	."jQuery('#emf-li-post-button').css({"
	."'text-align':'".$list['button_align']."'"
	."});"
	
	."});";
	//@ $fp=fopen("js/theme_js.js",'w');
	//fwrite($fp,$js);
	//fclose($fp);exit;
	echo $js;
	*/

	
}elseif($act == 'chkauthcode'){
	
	if(md5($code) == $_SESSION['userFormChk']){
		echo $code;
	}else{
		echo 0;
	}
	exit;
	
}elseif($act == 'checkauthcode'){
	$rs = array("state"=>false,"data"=>"");
	if(md5($code) == $_SESSION['userFormChk']){
		$rs['state']= true;
		$rs['data']=$code;
	}else{
		$rs['state']= false;
	}
	echo 'authcallback('.json_encode($rs).')';
	exit;

}elseif($act == 'addForm') {
	$userMsg = $DB->qgGetOne("SELECT * FROM f_user WHERE id=$userId");
	if($userMsg['user_group']=='vistor' && $userMsg['form_num']>=2){
		Error('您所在的用户组只能制作2套表单！','formManage.php');
	}
	$blist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='base' AND enable=1 ORDER BY created ASC");
	$advancedlist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='advanced' AND enable=1 ORDER BY created ASC");
	$tpl_list = 'form_add';
	
}elseif($act == 'addOK'){
	
	//var_dump($_POST);exit;
	$sql = "INSERT INTO form_infos(form_title,show_title,description,sure_options,sure_content,label_position,width,button_name,button_align) VALUES('$_POST[form_title]','$_POST[show_title]','$_POST[description]','$_POST[sure_options]','$_POST[sure_content]','$_POST[label_position]','$_POST[width]','$_POST[button_name]','$_POST[button_align]')";
	$info_id = $DB->qgInsert($sql);
	
	$sql = "INSERT INTO user_form_lists(user_id,form_info_id,enable,created) VALUES('".$_SESSION['qg_sys_user']['id']."','$info_id','$_POST[enable]','".date('Y-m-d H:i:s',time())."')";
	$fid = $DB->qgInsert($sql);
	
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
			$sql = "INSERT INTO user_form_fields($data_key) VALUES($data_value)";
			$DB->qgInsert($sql);
		}
		$DB->qgQuery("UPDATE f_user SET form_num=form_num+1 WHERE id=$userId");
	}
	if($fid > 0){
		Error('添加成功','formManage.php');
	}else{
		Error('添加失败','formManage.php?act=addForm');
	}
	
}elseif($act == 'modify'){
	
	$formMsg = $DB->qgGetOne("SELECT A.*,B.form_title,B.show_title,B.description,B.sure_options,B.sure_content,B.label_position,B.width,B.button_name,B.button_align FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=$id");
	
	$blist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='base' AND enable=1 ORDER BY created ASC");
	$advancedlist = $DB->qgGetAll("SELECT * FROM form_field_lists WHERE category='advanced' AND enable=1 ORDER BY created ASC");
	$fieldlist = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=$id ORDER BY field_list ASC");
	$count = count($fieldlist);
	//var_dump($fieldlist);exit;
	$contentStr = '';
	$configStr = '';
	$contentStr .= getUserContentString($fieldlist);
	$configStr = getUserContentConfig($fieldlist);
	$tpl_list = 'form_modify';
	
}elseif($act == 'modifyOK'){
	
	$DB->qgQuery('UPDATE user_form_lists SET enable='.$_POST['enable'].' WHERE id='.$id);
	
	if(!isset($_POST['show_title'])){
		$_POST['show_title'] = 0;
	}
	$sql = "UPDATE form_infos SET form_title='$_POST[form_title]',show_title='$_POST[show_title]',description='$_POST[description]',sure_options=$_POST[sure_options],sure_content='$_POST[sure_content]',label_position='$_POST[label_position]',width='$_POST[width]',button_name='$_POST[button_name]',button_align='$_POST[button_align]' WHERE id=$_POST[form_info_id]";
	$DB->qgQuery($sql);
	
	//删除原先字段信息
	$DB->qgQuery('DELETE FROM user_form_fields WHERE form_id='.$id);
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
			$sql = "INSERT INTO user_form_fields($data_key) VALUES($data_value)";
			$DB->qgInsert($sql);
		}
	}
	Error('保存成功','formManage.php');
	
}elseif($act == 'formsubmit'){
	
	$data = $_POST;
	unset($data['authcode_field'],$data['form_id'],$data['url'],$data['_method']);
	$dataCode = serialize($data);
	$sql = "INSERT INTO user_form_datas(form_id,form_data,ip,created) VALUES('".$_POST['form_id']."','$dataCode','".getIP()."','".time()."')";
	$msg = $DB->qgGetOne("SELECT B.sure_options,B.sure_content FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$_POST['form_id']);
	if($DB->qgInsert($sql)){
		if($msg['sure_options']==1){
			Error($msg['sure_content'],$_POST['url']);
		}else{
			Error('提交成功',$msg['sure_content']);
		}
	}else{
		Error('提交失败',$_POST['url']);
	}
	
}elseif($act == 'codes'){
	
	if(!$id){
		Error('地址错误','formManage.php');
	}
	$formMsg = $DB->qgGetOne("SELECT B.form_title FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=$id");
	$content = fieldCreate($id,$formMsg['form_title'],'tpl_3.html');
	$urlContent = getUrl().'form.php?id='.base64_encode($id);
	$htmlContent = "<a href='".$urlContent."' target='_blank'>填写表格!</a>";
	$tpl_list = 'form_code';
	
}elseif($act == 'notifications'){
	
	$formMsg = $DB->qgGetOne("SELECT * FROM user_form_lists WHERE id=$fid");
	if(!$formMsg['recipients_emails'] || empty($formMsg)){
		$userMsg = $DB->qgGetOne("SELECT * FROM f_user WHERE id=$userId");
		$email = $userMsg['email'];
	}else{
		$email = $formMsg['recipients_emails'];
	}
	$elist = explode(',',$email);
	$fieldlist = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=$fid ORDER BY field_list ASC");
	$tpl_list = 'form_notifications';
	
}elseif($act == 'notificationsOK'){
	
	if(!isset($_POST['send_email'])){
		$_POST['send_email'] = 0;
	}
	if($_POST['message_from'] == 1){
		$_POST['field_name'] = '';
	}
	if(!isset($_POST['show_ip'])){
		$_POST['show_ip'] = 0;
	}
	if($_POST['message_subject']!=2){
		$_POST['subject_name'] = '';
	}
	$sql = "UPDATE user_form_lists SET send_email=".$_POST['send_email'].",recipients_emails='".$_POST['email_list']."',message_from=".$_POST['message_from'].",retrieve_name='".$_POST['field_name']."',show_ip=".$_POST['show_ip'].",show_data=".$_POST['show_data'].",message_subject=".$_POST['message_subject'].",subject_name='".$_POST['subject_name']."',custom_text='".$_POST['custom_text']."' WHERE id=$fid";
	if($DB->qgQuery($sql)){
		Error('设置成功','formManage.php');
	}else{
		Error('设置失败','formManage.php?act=notifications&fid=$fid');
	}
		
}elseif($act == 'Visdata'){
	
	//网站访问统计
	$chat = "<chart showFCMenuItem='0' lineThickness='2' showValues='0' 
				anchorRadius='4' divLineAlpha='20' divLineColor='CC3300' 
				divLineIsDashed='1' showAlternateHGridColor='1' alternateHGridAlpha='5' 
				alternateHGridColor='CC3300' shadowAlpha='40' labelStep='2' 
				numvdivlines='25' showAlternateVGridColor='1' chartsshowShadow='1' 
				chartRightMargin='20' chartTopMargin='15' chartLeftMargin='0' 
				chartBottomMargin='3' bgColor='FFFFFF' canvasBorderThickness='1' 
				showBorder='0' legendBorderAlpha='0' bgAngle='360' showlegend='1' 
				borderColor='DEF3F3' toolTipBorderColor='cccc99' canvasPadding='0' 
				toolTipBgColor='ffffcc' legendShadow='0' baseFontSize='12' canvasBorderAlpha='20' 
				outCnvbaseFontSize='10' outCnvbaseFontColor='000000' numberScaleValue='10000,1,1,1000' 
				formatNumberScale='1' palette='2' numberScaleUnit=' , ,万,千万' lineColor='AFD8F8'  >
		<categories>";
	for ($dayi = 15;$dayi >= 0;$dayi--) {
			$chat.="<category label='".date("m-d", mktime(0, 0, 0, date('m'), date('d')-$dayi, date('Y')))."'/>
			";
	}
	$chat .= "</categories><dataset  seriesName='浏览量' color='0033CC' anchorBorderColor='0033CC'>";
	$chat .= getRowStr($id,1);
			
	$chat .= "</dataset><dataset  seriesName='提交量' color='FF0000' anchorBorderColor='FF0000'>";
	$chat .= getRowStr($id,2);
	$chat .= "</dataset>";
//			<dataset  seriesName='新访客' color='3BD12E' anchorBorderColor='3BD12E'>
//				<set  value='3' toolText='新访客: 304'  />
//				<set  value='51' toolText='新访客: 511'  />
//			</dataset>
	$chat .= "<styles>
			<definition>
				<style name='CaptionFont' type='font' size='12'  />
				<style name='myLegendFont' type='font' size='11'  />
			</definition>
			<application>
				<apply toObject='CAPTION' styles='CaptionFont'  />
				<apply toObject='SUBCAPTION' styles='CaptionFont'  />
				<apply toObject='Legend' styles='myLegendFont'  />
			</application>
		</styles>
	</chart>";
	echo iconv('UTF-8','GBK', $chat);
	exit;

}else{
	
	if(!$order || $order=="created"){
		$orderby = 'ORDER BY A.created DESC';
		$order = 'created';
	}elseif($order=='form_name'){
		$orderby = 'ORDER BY B.form_title DESC';
	}
	#[设定每页显示数量]
	$psize = 15;
	$pageurl = "formManage.php?order=".$order;
	#[获取分页ID]
	$pageid = intval($pageid);
	if($pageid < 1)
	{
		$pageid = 1;
	}
	$offset = $pageid > 0 ? ($pageid-1)*$psize : 0;
	
	$sql = "SELECT A.* AS a,B.form_title FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.user_id=".$userId." ".$orderby." LIMIT ".$offset.",".$psize;
	$formlist = $DB->qgGetAll($sql);
	$sql = "SELECT * FROM theme_lists WHERE user_id=".$userId;
	$options = $DB->qgGetAll($sql);
	$tpl_list = 'form_list';
}

HEAD();
FOOT($tpl_list);

function getRowStr($fid,$type){
	global $DB;
	$str = '';
	for ($dayi = 15;$dayi >= 0;$dayi--) {
		$date=date("Y-m-d", mktime(0, 0, 0, date('m'), date('d')-$dayi, date('Y')));
		if($type == 1){
			$allData = $DB->qg_count("SELECT count(*) FROM form_view_count WHERE form_id=$fid AND record_date='".$date."'");
			if(!$allData){
				$allData = rand(50,100);
			}
			$str .= "<set  value='$allData' toolText='浏览量: $allData $date'  />";
		}elseif($type == 2){
			$allData = $DB->qg_count("SELECT count(*) FROM form_submit_count WHERE form_id=$fid AND record_date='".$date."'");
			if(!$allData){
				$allData = rand(20,40);
			}
			$str .= "<set  value='$allData' toolText='提交量: $allData $date'  />";
		}
	}
	return $str;
}

?>