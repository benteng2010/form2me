<?php
require_once("global.php");

if($act == 'submit'){
	$data = $_POST;
	unset($data['authcode_field'],$data['form_id'],$data['url'],$data['_method']);
	$dataCode = serialize($data);
	$sql = "INSERT INTO user_form_datas(form_id,form_data,ip,created) VALUES('".$_POST['form_id']."','$dataCode','".getIP()."','".date('Y-m-d H:i:s',$system_time)."')";
	$msg = $DB->qgGetOne("SELECT A.*,B.sure_options,B.sure_content,B.form_title FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$_POST['form_id']);
	if($DB->qgInsert($sql)){
		if($msg['send_email'] == 1){
			$list = $DB->qgGetAll("SELECT * FROM user_form_fields WHERE form_id=".$_POST['form_id']." ORDER BY field_list ASC");
			if($msg['message_from']==1){
				$from = "Email Me Form";
			}else{
				$from = $msg['retrieve_name'];
			}
			if($msg['message_subject']==1){
				$subject = $msg['form_title'];
			}elseif($msg['message_subject']){
				$subject = $msg['custom_text'];
			}else{
				$subject = $msg['subject_name'];
			}
			$content = '<p>来自'.$from.'的消息</p><br/>';
			$content .= '<div id="contentDiv" class="" style="position:relative;font-size:14px;height:auto;padding:15px 15px 10px 15px;*padding:15px 15px 0 15px;overflow:visible;line-height:170%;min-height:100px;_height:100px;">';
			$content .= '<p>您的表单"'.$msg['form_title'].'"有一个新的提交信息</p><br/>';
			if($msg['show_data']==1){
				$content .= '<div style="font-size: 14px; padding: 0pt; height: auto; font-family:\'lucida Grande\',Verdana; margin-right: 170px;" id="mailContentContainer"><p><b>'.$msg['form_title'].'</b></p><table border="1"><tbody>';
				foreach($list AS $key=>$value){
				  $content .= '<tr>'
				  .'<th>'.$value['field_name'].'：</th><td>'.(gettype($_POST['element_'.$key])=='array'?implode(',',$_POST['element_'.$key]):$_POST['element_'.$key]).'</td>'
				  .'</tr>';
				}
				$content .= '</tbody></table></div>';
			}
			if($msg['show_ip']==1){
				$content .= '<p>提交者的IP为'.getIP().'</p>';
			}
			$content .= '</div>';
			SendEmail($msg['recipients_emails'],$subject,$content);
		}
		$DB->qgInsert("INSERT INTO form_submit_count(form_id,user_ip,record_date) VALUES('".$_POST['form_id']."','".getIP()."','".date("Y-m-d",$system_time)."')");
		if($msg['sure_options']==1){
			Error($msg['sure_content'],$_POST['url'],0);
		}else{
			Error('提交成功',$msg['sure_content'],1);
		}
	}else{
		Error('提交失败',$_POST['url']);
	}
}elseif($act == 'createFormStyle'){

	$id = base64_decode($id);
	$formMsg = $DB->qgGetOne("SELECT B.backgrounds,B.text,B.borders FROM user_form_lists AS A LEFT JOIN theme_lists AS B ON A.form_style_id=B.id WHERE A.id=".$id);
	$list = $DB->qgGetOne("SELECT B.button_align,B.width FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$id);
	$bg = unserialize($formMsg['backgrounds']);
	$text = unserialize($formMsg['text']);
	$border = unserialize($formMsg['borders']);
	
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
	exit;
	
}else{
	$id = base64_decode($id);
	$DB->qgInsert("INSERT INTO form_view_count(form_id,user_ip,record_date) VALUES($id,'".getIP()."','".date("Y-m-d",$system_time)."')");
	$formMsg = $DB->qgGetOne("SELECT B.form_title FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$id);
	$content = fieldCreate($id,$formMsg['form_title']);
	$tpl_list = 'form_view';
	HEAD();
	FOOT($tpl_list);
}

?>