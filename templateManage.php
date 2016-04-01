<?php
require_once("global.php");
if(!USER_STATUS){
	Error('请先登录','login.php');
}
$userId = $_SESSION['qg_sys_user']['id'];
$controller = 'templateManage';

if($act == 'customze'){
	
	$formMsg = $DB->qgGetOne("SELECT * FROM sys_form_lists WHERE id=$id");
	$sql = "INSERT INTO user_form_lists(user_id,form_info_id,enable,created) VALUES($userId,".$formMsg['form_info_id'].",1,'".date("Y-m-d H:i:s",$system_time)."')";
	$fid = $DB->qgInsert($sql);
	$fieldlist = $DB->qgGetAll("SELECT * FROM sys_form_fields WHERE form_id=$id ORDER BY field_list ASC");
	foreach($fieldlist AS $key=>$value){
		$sql = "INSERT INTO user_form_fields(form_id,field_name,field_type,field_list,field_label,is_required,show_field,field_cols,field_rows,range_min,range_max,instructions,default_value,field_size,checkbox_choice,checkbox_choice_checked,multiple_choice,multiple_choice_checked,dropdown_choice,dropdown_choice_selected) VALUES($fid,'".$value['field_name']."','".$value['field_type']."','".$value['field_list']."','".$value['field_label']."','".$value['is_required']."','".$value['show_field']."','".$value['field_cols']."','".$value['field_rows']."','".$value['range_min']."','".$value['range_max']."','".$value['instructions']."','".$value['default_value']."','".$value['field_size']."','".$value['checkbox_choice']."','".$value['checkbox_choice_checked']."','".$value['multiple_choice']."','".$value['multiple_choice_checked']."','".$value['dropdown_choice']."','".$value['dropdown_choice_selected']."')";
		$DB->qgInsert($sql);
	}
	header('Location:formManage.php?act=modify&id='.$fid);
	
}else{
	
	$catelist = $DB->qgGetAll("SELECT * FROM f_category WHERE sysgroupid=4 AND rootid=0 ORDER BY id ASC");
	$formId = 0;
	foreach($catelist AS $key=>$value) {
		$formlist[$value['id']] = $DB->qgGetAll("SELECT A.*,B.form_title FROM sys_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.category=".$value['id']." ORDER BY A.id ASC");
		if($formId == 0){
			$formId = $formlist[$value['id']][0]['id'];
			$title = $formlist[$value['id']][0]['form_title'];
		}
	}
	$fieldlist = $DB->qgGetAll("SELECT * FROM sys_form_fields WHERE form_id=$formId ORDER BY field_list ASC");
	$contentStr = getTemplateString($fieldlist);
	
	HEAD();
	FOOT('template_list');
	
}

function getTemplateString($list){
	$str = '';
	if(!empty($list)){
		$str .= '<table cellspacing="0" cellpadding="2" border="0" bgcolor="transparent" style="text-align:left;">';
		$str .= '<tbody>';
		foreach($list AS $key=>$value){
			if($value['field_type'] == 'text'){
				$str .= '<tr valign="top">';
				$str .= '<td id="td_element_label_'.$value['field_list'].'">';
				$str .= '<font size="2" face="Verdana" color="#000"><b>'.$value['field_label'].'</b></font>'.($value['is_required']==1?'<span class="req"> * </span>':'');
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '</td></tr>';
				
				$str .= '<tr>';
				$str .= '<td id="td_element_field_'.$value['field_list'].'">';
				if($value['field_size']){
					$str .= '<input id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" class="text " type="text" size="'.$value['field_size'].'" value="'.$value['default_value'].'" readonly="readonly">';
				}else{
					$str .= '<input id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" class="text " type="text" value="'.$value['default_value'].'" readonly="readonly">';
				}
				$str .= '<div style="padding-bottom:8px;color:#000000;"><small><font face="Verdana"></font></small></div>';
				$str .= '</td></tr>';
			}elseif($value['field_type'] == 'textarea'){
				
				$str .= '<tr valign="top">';
				$str .= '<td id="td_element_label_'.$value['field_list'].'">';
				$str .= '<font size="2" face="Verdana" color="#000"><b>'.$value['field_label'].'</b></font>'.($value['is_required']==1?'<span class="req"> * </span>':'');
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '</td></tr>';
				
				$str .= '<tr>';
				$str .= '<td id="td_element_field_'.$value['field_list'].'">';
				$str .= '<textarea id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" rows="'.($value['field_rows']>0?$value['field_rows']:10).'" cols="'.($value['field_cols']>0?$value['field_cols']:60).'">'.$value['default_value'].'</textarea>';
				$str .= '<div style="padding-bottom:8px;color:#000000;"><small><font face="Verdana"></font></small></div>';
				$str .= '</td></tr>';
				
			}elseif($value['field_type'] == 'radio'){
				
				$str .= '<tr valign="top">';
				$str .= '<td id="td_element_label_'.$value['field_list'].'">';
				$str .= '<font size="2" face="Verdana" color="#000"><b>'.$value['field_label'].'</b></font>'.($value['is_required']==1?'<span class="req"> * </span>':'');
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '</td></tr>';
				
				$str .= '<tr>';
				$str .= '<td id="td_element_field_'.$value['field_list'].'">';
				$data = unserialize($value['multiple_choice']);
				foreach($data AS $k=>$v){
					$str .= '<div style="width:100%;padding-bottom:5px;">';
					if($value['multiple_choice_checked'] == $v){
						$str .= '<input id="element_'.$value['field_list'].'_'.$k.'" type="radio" value="'.$v.'" name="element_'.$value['field_list'].'" checked="checked" />';
					}else{
						$str .= '<input id="element_'.$value['field_list'].'_'.$k.'" type="radio" value="'.$v.'" name="element_'.$value['field_list'].'" />';
					}
					$str .= '<font size="2" face="Verdana" color="#000000">&nbsp;'.$v.'&nbsp;</font>';
					$str .= '</div>';
				}
				$str .= '</td></tr>';
				
			}elseif($value['field_type'] == 'checkbox'){
				
				$str .= '<tr valign="top">';
				$str .= '<td id="td_element_label_'.$value['field_list'].'">';
				$str .= '<font size="2" face="Verdana" color="#000"><b>'.$value['field_label'].'</b></font>'.($value['is_required']==1?'<span class="req"> * </span>':'');
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '</td></tr>';
				
				$str .= '<tr>';
				$str .= '<td id="td_element_field_'.$value['field_list'].'">';
				$data = unserialize($value['checkbox_choice']);
				$checked = unserialize($value['checkbox_choice_checked']);
				foreach($data AS $k=>$v){
					$str .= '<div style="width:100%;padding-bottom:5px;">';
					if(!$checked){
						$str .= '<input id="element_'.$value['field_list'].'_'.$k.'" type="checkbox" value="'.$v.'" name="element_'.$value['field_list'].'[]" />';
					}else{
						if(in_array($v,$checked)){
							$str .= '<input id="element_'.$value['field_list'].'_'.$k.'" type="checkbox" value="'.$v.'" name="element_'.$value['field_list'].'[]" checked="checked" />';
						}else{
							$str .= '<input id="element_'.$value['field_list'].'_'.$k.'" type="checkbox" value="'.$v.'" name="element_'.$value['field_list'].'[]" />';
						}
					}
					$str .= '<font size="2" face="Verdana" color="#000000">&nbsp;'.$v.'&nbsp;</font>';
					$str .= '</div>';
				}
				$str .= '</td></tr>';
				
			}elseif($value['field_type'] == 'select'){
				
				$str .= '<tr valign="top">';
				$str .= '<td id="td_element_label_'.$value['field_list'].'">';
				$str .= '<font size="2" face="Verdana" color="#000"><b>'.$value['field_label'].'</b></font>'.($value['is_required']==1?'<span class="req"> * </span>':'');
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '</td></tr>';
				
				$str .= '<tr>';
				$str .= '<td id="td_element_field_'.$value['field_list'].'">';
				$str .= '<select name="element_'.$value['field_list'].'" id="element_'.$value['field_list'].'">';
				$data = unserialize($value['dropdown_choice']);
				if($value['dropdown_choice_selected']){
					$str .= '<option value="">请选择</option>';
					foreach($data AS $v){
						if($value['dropdown_choice_selected'] == $v){
							$str .= '<option value="'.$v.'" selected="selected">'.$v.'</option>';
						}else{
							$str .= '<option value="'.$v.'" >'.$v.'</option>';
						}
					}
				}else{
					$str .= '<option value="" selected="selcted">请选择</option>';
					foreach($data AS $v){
						$str .= '<option value="'.$v.'" >'.$v.'</option>';
					}
				}
				if($value['field_size']){
					$str .= '<input id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" class="text " type="text" size="'.$value['field_size'].'" value="'.$value['default_value'].'" readonly="readonly">';
				}else{
					$str .= '<input id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" class="text " type="text" value="'.$value['default_value'].'" readonly="readonly">';
				}
				$str .= '<div style="padding-bottom:8px;color:#000000;"><small><font face="Verdana"></font></small></div>';
				$str .= '</td></tr>';
			}
		}
		$str .= '</tdody></table>';
	}
	return $str;
}

?>