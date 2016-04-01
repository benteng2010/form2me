<?php
#[常用函数管理]
function Error($msg="操作错误",$url="",$time=2)
{
	global $DB,$system,$langs;
	global $TPL;
	$TPL->set_var("error_msg",$msg);
	$TPL->set_var("error_time",$time);
	$TPL->set_var("error_url",$url);
	$TPL->p("error.sys");
	rewrite();
}

function qgheader($url="home.php")
{
	global $TPL;
	$url = $url ? $url : "home.php";
	ob_end_clean();
	header("Location:".$url);
	exit;
}

function ErrorMsg($msg="操作不正确")
{
	Error($msg);
}

#[检测缓存文件是否超时]
function CheckCache($filename)
{
	global $system;
	global $system_time;
	if(!$filename)
	{
		return false;
	}
	$system["mintime"] = $system["mintime"] ? intval($system["mintime"]) : 0;
	if(!file_exists($filename))
	{
		return false;
	}
	if(!$system["maxtime"] || $system["maxtime"] < 1)
	{
		return false;
	}
	if((@filemtime($filename) + rand($system["mintime"],$system["maxtime"])) <= $system_time)
	{
		return false;
	}
	return true;
}

#[获取指定语言ID的分类信息，这里只读取ID号信息，其他的不读]
function GetCateIdAll($langid)
{
	global $DB,$prefix;
	$rs = $DB->qgGetAll("SELECT id FROM ".$prefix."category WHERE language='".LANGUAGE_ID."'");
	$rsid = array();
	foreach($rs AS $key=>$value)
	{
		$rsid[$value["id"]] = $value["id"];
	}
	return $rsid;
}

#[管理无限级别分类]
function menu_list($catelist,$cateid,$array=array())
{
	foreach($catelist AS $key=>$value)
	{
		if($value["id"] == $cateid)
		{
			$array[$key] = $value;
			$array = menu_list($catelist,$value["parentid"],$array);
		}
	}
	return $array;
}

#[根据当前分类得到子分类ID]
function get_son_list($catelist,$cateid,$array=array())
{
	foreach($catelist AS $key=>$value)
	{
		if($value["parentid"] == $cateid)
		{
			$array[$key] = $value["id"];
			$array = get_son_list($catelist,$value["id"],$array);
		}
	}
	return $array;
}

function page($url,$total=0,$psize=30,$pageid=0,$halfPage=5,$type='')
{
	global $langs;
	if(empty($psize))
	{
		$psize = 30;
	}
	#[添加链接随机数]
	if(strpos($url,"?") === false)
	{
		$url = $url."?qgrand=phpok";
	}
	#[共有页数]
	$totalPage = intval($total/$psize);
	if($total%$psize)
	{
		$totalPage++;#[判断是否存余，如存，则加一
	}
	#[判断分页ID是否存在]
	if(empty($pageid))
	{
		$pageid = 1;
	}
	#[判断如果分页ID超过总页数时]
	if($pageid > $totalPage)
	{
		$pageid = $totalPage;
	}
	#[Html]
	$array_m = 0;
	if($pageid > 0)
	{
		$returnlist[$array_m]["url"] = $url;
		$returnlist[$array_m]["name"] = $langs["page_first"];
		$returnlist[$array_m]["status"] = 0;
		if($pageid > 1)
		{
			$array_m++;
			$returnlist[$array_m]["url"] = $url."&pageid=".($pageid-1);
			$returnlist[$array_m]["name"] = $langs["page_front"];
			$returnlist[$array_m]["status"] = 0;
		}else{
			$array_m++;
			$returnlist[$array_m]["url"] = '#';
			$returnlist[$array_m]["name"] = $langs["page_front"];
			$returnlist[$array_m]["status"] = 0;
		}
	}
	#[添加中间项]
	for($i=$pageid-$halfPage,$i>0 || $i=0,$j=$pageid+$halfPage,$j<$totalPage || $j=$totalPage;$i<$j;$i++)
	{
		$l = $i + 1;
		$array_m++;
		$returnlist[$array_m]["url"] = $url."&pageid=".$l;
		$returnlist[$array_m]["name"] = $l;
		$returnlist[$array_m]["status"] = ($l == $pageid) ? 1 : 0;
	}
	#[添加select里的中间项]
	for($i=$pageid-$halfPage*3,$i>0 || $i=0,$j=$pageid+$halfPage*3,$j<$totalPage || $j=$totalPage;$i<$j;$i++)
	{
		$l = $i + 1;
		$select_option_msg = "<option value='".$l."'";
		if($l == $pageid)
		{
			$select_option_msg .= " selected";
		}
		$select_option_msg .= ">".$l."</option>";
		$select_option[] = $select_option_msg;
	}
	#[添加尾项]
	if($pageid < $totalPage)
	{
		$array_m++;
		$returnlist[$array_m]["url"] = $url."&pageid=".($pageid+1);
		$returnlist[$array_m]["name"] = $langs["page_back"];
		$returnlist[$array_m]["status"] = 0;
	}else{
		$array_m++;
		$returnlist[$array_m]["url"] = '#';
		$returnlist[$array_m]["name"] = $langs["page_back"];
		$returnlist[$array_m]["status"] = 0;
	}
	$array_m++;
	$returnlist[$array_m]["url"] = $url."&pageid=".$totalPage;
	$returnlist[$array_m]["name"] = $langs["page_last"];
	$returnlist[$array_m]["status"] = 0;
	#[内容组成html]
	#[组织样式]
	
	if(isset($type) && $type=='data'){
		if($totalPage == 1){
			$prev = '<span class="prevbtn"></span>';
			$next = '<span class="nextbtn"></span>';
		}else{
			foreach($returnlist AS $key=>$value)
			{
				if($value['name'] == '上一页'){
					$prev = '<span class="prevbtn" onclick="javascript:window.location.href=\''.$value["url"].'\';"></span>';
				}elseif($value['name'] == '下一页'){
					$next = '<span class="nextbtn" onclick="javascript:window.location.href=\''.$value["url"].'\';"></span>';
				}
			}
		}
		$msg = $prev.'<span>'.$pageid.'-'.$totalPage.'</span><em>of</em><span>'.$total.'</span>'.$next;
	}else{
		$msg = "<table class='pagelist'><tr><td class='n'>".$pageid."/".$total."</td>";
		foreach($returnlist AS $key=>$value)
		{
			if($value["status"])
			{
				$msg .= "<td class='m'>".$value["name"]."</td>";
			}
			else
			{
				$msg .= "<td class='n'><a href='".$value["url"]."'>".$value["name"]."</a></td>";
			}
		}
		//$msg .= "<td><select onchange=\"window.location='".$url."&pageid='+this.value+''\">".implode("",$select_option)."</option></select></td>";
		$msg .= "</tr></table>";
	}
	unset($returnlist);
	return $msg;
}



function SafeHtml($msg="")
{
	global $STR;
	return $STR->safe($msg);
}

function FckHtml($msg="",$script=false,$iframe=false,$style=false)
{
	global $STR;
	$STR->set("script",$script);
	$STR->set("iframe",$iframe);
	$STR->set("style",$style);
	return $STR->html($msg);
}

function CutString($string,$length=10,$dot="…")
{
	global $STR;
	return $STR->cut($string,$length,$dot);
}
//
//function FckEditor($var="",$content="",$toolbar="",$height="",$width="100%")
//{
//	include_once("./class/fckeditor.class.php");
//	$var = $var ? $var : "content";
//	$fck = new FCKeditor($var) ;//获得一个变量信息
//	$sBasePath = $_SERVER['PHP_SELF'] ;
//	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
//	//$fck->BasePath = $sBasePath."include/editor/";
//	$fck->BasePath = $sBasePath."include/fckeditor/";
//	$fck->Value = $content;
//	$fck->Config['AutoDetectLanguage'] = false;
//	$fck->Config['DefaultLanguage'] = "zh-cn";
//	$fck->Config['ToolbarStartExpanded'] = true;
//	$fck->ToolbarSet = "Default";
//	$fck->Width = $width;
//	$fck->Height = $height;
//	$fck->Config['EnableXHTML'] = true;
//    $fck->Config['EnableSourceXHTML'] = true;
//	return $fck->CreateHtml();
//}


function FckEditor($var="",$content="",$toolbar="Default",$height="300px",$width="543px")
{
	include_once("fckeditor/fckeditor.php");
	$var = $var ? $var : "content";
	$fck = new FCKeditor($var) ;//获得一个变量信息
	$sBasePath = $_SERVER['PHP_SELF'] ;
	$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
	$fck->BasePath = $sBasePath."include/fckeditor/";
	$fck->Value = $content;
	$fck->Config['AutoDetectLanguage'] = false;
	$fck->Config['DefaultLanguage'] = "zh-cn";
	$fck->Config['ToolbarStartExpanded'] = true;
	$fck->ToolbarSet = "Default";
	$fck->Width = $width ? $width : "543px";
	$fck->Height = $height ? $height : "300px";
	$fck->Config['EnableXHTML'] = true;
    $fck->Config['EnableSourceXHTML'] = true;
	 return $fck->CreateHtml();
}

function SendEmail($email="",$subject="",$content="")
{
	global $system;
	if(empty($email))
	{
		return false;
	}
	include_once("./class/phpmailer.class.php");
	$SML = new PHPMailer();
	$SML->IsSMTP();
	$SML->Host = $system["mailhost"];
	$SML->Port = $system["mailport"] ? $system["mailport"] : 25;
	$SML->SMTPAuth = true;
	$SML->Username = $system["mailuser"];
	$SML->Password = $system["mailpass"];
	$SML->From = $system["mailqg"];
	$SML->FromName = $system["mailuser"];
	#[回复地址]
	if($system["adminemail"])
	{
		$SML->AddReplyTo($system["adminemail"]);
	}
	else
	{
		$SML->AddReplyTo($system["mailqg"]);
	}
	$SML->IsHTML(true);

	$SML->AddAddress($email);
	$SML->CharSet = $system["mailtype"] ? $system["mailtype"] : "utf8";
	if($system["mailtype"] == "gbk")
	{
		$subject = Utf2gb($subject);
		$content = Utf2gb($content);
	}
	$SML->Subject = $subject ? $subject : $email;
	$SML->Body = $content;
	if($SML->Send())
	{
		return true;
	}
	else
	{
		return false;
	}
}

function Utf2gb($utfstr)
{
	global $STR;
	return $STR->charset($utfstr,"UTF-8","GBK");
}

function GetSystemUrl()
{
	$myurl = "http://".str_replace("http://","",$_SERVER["SERVER_NAME"]);
	$docu = $_SERVER["PHP_SELF"];
	$array = explode("/",$docu);
	$count = count($array);
	if($count>1)
	{
		foreach($array AS $key=>$value)
		{
			$value = trim($value);
			if($value)
			{
				if(($key+1) < $count)
				{
					$myurl .= "/".$value;
				}
			}
		}
	}
	$myurl .= "/";
	return $myurl;
}

function HEAD()
{
	global $FS,$DB,$prefix;
	global $TPL;
	if(!file_exists("data/nav_".LANGUAGE_ID.".php"))
	{
		include_once("data/nav_".LANGUAGE_ID.".php");
	}
	else
	{
		$sql = "SELECT * FROM ".$prefix."nav WHERE language='".LANGUAGE_ID."' ORDER BY taxis ASC,id DESC";
		$qgnav = $DB->qgGetAll($sql);
		$FS->qgWrite($qgnav,"data/nav_".$language.".php","qgnav");
	}
	$TPL->set_var("qgnav",$qgnav);
}
function FOOT($tplfile)
{
	global $FS,$DB,$prefix;
	global $TPL;
	#[引入页脚信息]
	$TPL->p($tplfile);
	REWRITE();
}


function REWRITE()
{
	global $urlRewrite,$system,$siteurl;
	if($urlRewrite)
	{
		#[定义常量，这些常量是给Rewrite用的]
		define("RW_SITE_URL",$siteurl);
		define("RW_TPL_FOLDER",TPL_FOLDER);
		define("RW_UPFILES","upfiles");
		define("RW_LANG",LANGUAGE_SIGN);
		include_once("class/rewrite.class.php");
		$RW = new Rewrite();
		$content = ob_get_contents();
		ob_end_clean();
		$content = $RW->qg_rewrite($content);
		echo $content;
		ob_end_flush();
	}
	exit;
}

function ContentPageArray($content,$url,$pageid=0)
{
	$page_content = explode("[:page:]",$content);
	$pageid = intval($pageid);
	if($pageid < 1)
	{
		$pageid = 1;
	}
	$page_total = count($page_content);
	$pagelist = page($url,$page_total,1,$pageid);#[获取分页的数组]
	$content = $page_content[($pageid-1)];
	$content = preg_replace("/<div/isU","<p style='margin-top:0px;margin-bottom:0px;padding:0px;'",$content);
	$content = preg_replace("/<\/div>/isU","</p>",$content);
	return array($content,$pagelist);
}

#[显示语言及模板]
function SelectLangTpl()
{
	global $DB,$prefix,$FS;
	if(file_exists("data/cache/lang_select.php"))
	{
		include_once("data/cache/lang_select.php");
	}
	else
	{
		$langlist = $DB->qgGetAll("SELECT sign,name FROM ".$prefix."lang WHERE ifuse='1' ORDER BY ifdefault DESC,sign ASC,id DESC");
		$FS->qgWrite($langlist,"data/cache/lang_select.php","langlist");
	}
	$select = "<table cellpadding='1' cellspacing='0'><tr><td><select onchange='sys_change_lang(this.value)'>";
	foreach((is_array($langlist) ? $langlist : array()) AS $key=>$value)
	{
		$select .= "<option value='".$value["sign"]."'";
		if($value["sign"] == $_SESSION["qglang"]["sign"])
		{
			$select .= " selected";
		}
		$select .= ">".$value["name"]."</option>";
	}
	$select .= "</select>";
	$select .= "</td><td>";
	$select .= "<select onchange='sys_change_tpl(this.value)'>";
	if(file_exists("data/cache/style_select_".LANGUAGE_ID.".php"))
	{
		include_once("data/cache/style_select_".LANGUAGE_ID.".php");
	}
	else
	{
		$tpl_list = $DB->qgGetAll("SELECT folder,name FROM ".$prefix."tpl WHERE language='".LANGUAGE_ID."' ORDER BY isdefault DESC,taxis ASC,id DESC");
		$FS->qgWrite($tpl_list,"data/cache/style_select_".LANGUAGE_ID.".php","tpl_list");
	}
	foreach((is_array($tpl_list) ? $tpl_list : array()) AS $key=>$value)
	{
		$select .= "<option value='".$value["folder"]."'";
		if($value["folder"] == $_SESSION["tpl_folder"])
		{
			$select .= " selected";
		}
		$select .= ">".$value["name"]."</option>";
	}
	$select .= "</select>";
	$select .= "</td></tr></table>";
	$select .= "<span style='display:none;'><script type='text/javascript'>\nfunction sys_change_lang(m){var url='home.php?langsign='+m;window.location.href=url;}\n";
	$select .= "function sys_change_tpl(m){var url='home.php?template='+m;window.location.href=url;}</script></span>";
	$FS->qgWrite($select,"data/cache/lang_style_select.php");
	return $select;
}
#[兼容sqlite数据库]
function reSetRs($rslist=array(),$num='all'){
	$rs=array();
	if($num=='all'){
		foreach($rslist as $key=>$value){
			$rsValue=array();
				foreach($value as $k=>$v){
					$keyarr=explode(".",$k);
					if(count($keyarr)>=2)
						$rsValue[$keyarr[1]]=$v;
					else
						$rsValue[$k]=$v;
					}
			$rs[]=$rsValue;		
		}
	}
	if($num=='one'){
		foreach($rslist as $k=>$v){
				$keyarr=explode(".",$k);
					if(count($keyarr)>=2)
						$rs[$keyarr[1]]=$v;
					else
					$rs[$k]=$v;
		}
	}
	return $rs;
}

#[创建表单字段]
function fieldCreate($id,$form_title,$tpl='tpl.html') {
	global $DB;
	$formInfo = $DB->qgGetOne('SELECT A.*,B.form_style_id FROM form_infos AS A LEFT JOIN user_form_lists AS B ON A.id=B.form_info_id WHERE B.id='.$id);
	$content = '';
	$content = file_get_contents('form_tpl/'.$tpl);
	$content = ereg_replace("HOST", getUrl(), $content);
	$content = ereg_replace("FORMID", $id, $content);
	$content = ereg_replace("ID", base64_encode($id), $content);
	if($formInfo['show_title']){
		$content = ereg_replace("FORMTITLE", $form_title, $content);
	}else{
		$content = ereg_replace("FORMTITLE", '', $content);
	}
	if($formInfo['form_style_id']==0){
		if($formInfo['button_name']){
			$content = ereg_replace("BUTTON", '<input type="button" value="'.$formInfo['button_name'].'" onclick="checkinfo();" />', $content);
		}else{
			$content = ereg_replace("BUTTON", '<input type="button" value="提交" onclick="checkinfo();" />', $content);
		}
	}else{
		$stylelist = $DB->qgGetOne('SELECT * FROM theme_lists WHERE id='.$formInfo['form_style_id']);
		$button_style = unserialize($stylelist['button']);
		if($button_style['style']['button_type']=='text'){
			$content = ereg_replace("BUTTON", '<input type="button" value="'.$button_style['style']['button_caption'].'" onclick="checkinfo();"/>', $content);
		}else{
			$content = ereg_replace("BUTTON", '<img src="'.$button_style['style']['button_caption'].'" onclick="checkinfo();" style="cursor:pointer;"/>', $content);
		}
	}
	$content = ereg_replace("TIME", time(), $content);
	
	$fieldlist = $DB->qgGetAll('SELECT * FROM user_form_fields WHERE form_id='.$id.' ORDER BY field_list ASC');
	$str = '';
	if(!empty($fieldlist)){
		foreach($fieldlist AS $key=>$value){
			$str .= '<li id="emf-li-'.$key.'" typename="'.$value['field_type'].'" class="emf-li-field emf-field-text data_container " style="position:relative">';
			$str .= '<label class="emf-label-desc" for="element_'.$key.'"><a name="element_label_'.$key.'">'.$value['field_label'].'</a> '.($value['is_required']?'<span>*</span>':'').' </label>';
			$str .= '<div class="emf-div-field">';
			if(in_array($value['field_type'],array('text'))){
				$str .= '<span style="display:none;" type="text"></span>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;box-shadow:0px 0px 6px #000;border-radius: 5px; padding:2px 10px;border:2px solid #ddd; background:#f00;position:absolute; top:-15px;left:180px;line-height:22px;font-size:12px;color:#fff;" onclick="javascript:jQuery(this).parent().find(\'.err_img\').hide();">我是错误！</div>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;position:absolute; top:13px;left:190px;"><img src="'.getUrl().'templates/zh/default/images/jt.png" /></div>';
				$str .= '<input id="element_'.$key.'" class="text" type="text" size="30" value="'.$value['default_value'].'" name="element_'.$key.'" onKeyUp="checkValue(jQuery(this),\'text\');">';
			}elseif($value['field_type'] == 'textarea'){
				$str .= '<span style="display:none;" type="textarea"></span>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;box-shadow:0px 0px 6px #000;border-radius: 5px; padding:2px 10px;border:2px solid #ddd; background:#f00;position:absolute; top:-15px;left:480px;line-height:22px;font-size:12px;color:#fff;" onclick="javascript:jQuery(this).parent().find(\'.err_img\').hide();">我是错误！</div>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;position:absolute; top:13px;left:490px;"><img src="'.getUrl().'templates/zh/default/images/jt.png" /></div>';
				$str .= '<textarea id="element_'.$key.'" rows="'.$value['field_rows'].'" cols="'.$value['field_cols'].'" name="element_'.$key.'" style="width:516px;" onKeyUp="checkValue(jQuery(this),\'textarea\');">'.$value['default_value'].'</textarea>';
			}elseif($value['field_type'] == 'radio'){
				$data = unserialize($value['multiple_choice']);
				$str .= '<span style="display:none;" type="radio"></span>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;box-shadow:0px 0px 6px #000;border-radius: 5px; padding:2px 10px;border:2px solid #ddd; background:#f00;position:absolute; top:-10px;left:0px;line-height:22px;font-size:12px;color:#fff;" onclick="javascript:jQuery(this).parent().find(\'.err_img\').hide();">我是错误！</div>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;position:absolute; top:18px;left:10px;"><img src="'.getUrl().'templates/zh/default/images/jt.png" /></div>';
				foreach($data AS $k=>$v){
					$str .= '<div class="one_column">';
					if($value['multiple_choice_checked']==$v){
						$str .= '<input type="radio" id="element_'.$key.'_'.$k.'" name="element_'.$key.'" value="'.$v.'" checked="checked" onclick="checkValue(jQuery(this),\'radio\');"><label for="element_'.$key.'_'.$k.'">'.$v.'</label>';
					}else{
						$str .= '<input type="radio" id="element_'.$key.'_'.$k.'" name="element_'.$key.'" value="'.$v.'" onclick="checkValue(jQuery(this),\'radio\');"><label for="element_'.$key.'_'.$k.'">'.$v.'</label>';
					}
					$str .= '</div>';
				}
			}elseif($value['field_type'] == 'checkbox'){
				$data = unserialize($value['checkbox_choice']);
				$checked = unserialize($value['checkbox_choice_checked']);
				$str .= '<span style="display:none;" type="checkbox"></span>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;box-shadow:0px 0px 6px #000;border-radius: 5px; padding:2px 10px;border:2px solid #ddd; background:#f00;position:absolute; top:-10px;left:0px;line-height:22px;font-size:12px;color:#fff;" onclick="javascript:jQuery(this).parent().find(\'.err_img\').hide();">我是错误！</div>';
				$str .= '<div class="err_img" style="display:none;cursor:pointer;position:absolute; top:18px;left:10px;"><img src="'.getUrl().'templates/zh/default/images/jt.png" /></div>';
				foreach($data AS $k=>$v){
					$str .= '<div class="one_column">';
					if(!$checked){
						$str .= '<input type="checkbox" id="element_'.$key.'_'.$k.'" name="element_'.$key.'['.$k.']" value="'.$v.'" onclick="checkValue(jQuery(this),\'checkbox\');"><label for="element_'.$key.'_'.$k.'">'.$v.'</label>';
					}else{
						if(in_array($v,$checked)){
							$str .= '<input type="checkbox" id="element_'.$key.'_'.$k.'" name="element_'.$key.'['.$k.']" value="'.$v.'" checked="checked" onclick="checkValue(jQuery(this),\'checkbox\');"><label for="element_'.$key.'_'.$k.'">'.$v.'</label>';
						}else{
							$str .= '<input type="checkbox" id="element_'.$key.'_'.$k.'" name="element_'.$key.'['.$k.']" value="'.$v.'" onclick="checkValue(jQuery(this),\'checkbox\');"><label for="element_'.$key.'_'.$k.'">'.$v.'</label>';
						}
					}
					$str .= '</div>';
				}
			}elseif($value['field_type'] == 'select'){
				$str .= '<span style="display:none;" type="select"></span>';
				$str .= '<select name="element_'.$key.'">';
				$data = unserialize($value['dropdown_choice']);
				foreach($data AS $k=>$v){
					if($value['dropdown_choice_selected']==$v){
						$str .= '<option value="'.$v.'" selected="selected">'.$v.'</option>';
					}else{
						$str .= '<option value="'.$v.'" >'.$v.'</option>';
					}
				}
			}
			$str .= '</select></div>';
			$str .= '<div class="emf-clear"></div>';
			$str .= '</li>';
		}
	}
	$content = ereg_replace("CONTENT", $str, $content);
	$content = ereg_replace("TITLE", $form_title, $content);
	return $content;
}

//加载表单样式
function createFormStyle($id){
	
	global $DB;
	$formMsg = $DB->qgGetOne("SELECT B.backgrounds,B.text,B.borders FROM user_form_lists AS A LEFT JOIN theme_lists AS B ON A.form_style_id=B.id WHERE A.id=".$id);
	$list = $DB->qgGetOne("SELECT B.button_align,B.width FROM user_form_lists AS A LEFT JOIN form_infos AS B ON A.form_info_id=B.id WHERE A.id=".$id);
	$bg = unserialize($formMsg['backgrounds']);
	$text = unserialize($formMsg['text']);
	$border = unserialize($formMsg['borders']);
	
	$css = "<style type='text/css'>";
	$css .= ".emf-div-field input{"
	."background-color:".$bg['field']['color'].";"
	."color:".$text['field_text']['color'].";"
	."font-family:".$text['field_text']['font'].";"
	."font-style:".$text['field_text']['style'].";"
	."font-weight:".$text['field_text']['weight'].";"
	."font-size:".$text['field_text']['size']."px;"
	."}";
	
	$css .= ".emf-div-field textarea{"
	."background-color:".$bg['field']['color'].";"
	."color':".$text['field_text']['color'].";"
	."font-family:".$text['field_text']['font'].";"
	."font-style:".$text['field_text']['style'].";"
	."font-weight:".$text['field_text']['weight'].";"
	."font-size:".$text['field_text']['size']."px;"
	."}";
	
	$css .= ".emf-label-desc a{"
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
	."width:".($list['width']?$list['width']:'640')."px'"
	."background-color:".$bg['form']['color']."'"
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
	
	$css .= '</style>';
	
	return $css;
}

function getUrl()
{
	if($_SERVER['HTTP_HOST']=='localhost'){
		return 'http://localhost/form2me/';
	}elseif($_SERVER['HTTP_HOST']=='form2me.gootop.net'){
		return 'http://form2me.gootop.net/';
	}
}

function getUserContentConfig($list){
	$config = '';
	if(!empty($list)){
		foreach($list AS $key=>$value){
			 $config .= '<ul class="form_settings_ul" id="ul_'.$value['field_list'].'" style="display:none;">'
			 .'<li>'
			 .'<label class="form_settings_label">'
			 .'字段标签'
			 .'</label>'
			 .'<textarea name="form['.$value['field_list'].'][field_label]" class="form_text" style="width:100%;height:70px;color:#333;" onkeyup="setValue(jQuery(this),\'field_label\',\''.$value['field_list'].'\');">'.$value['field_label'].'</textarea>'
			 .'</li>'
			 .'<li class="form_settings_li_left">'
			 .'<fieldset>'
			 .'<legend class="form_settings_group">选项</legend>'
			 .'<div class="form_fieldset_div">'
			 .'<input class="form_checkbox" type="checkbox" value="1" name="form['.$value['field_list'].'][is_required]" '.($value['is_required']==1?'checked':'').' onchange="setRequire(jQuery(this),\''.$value['field_list'].'\');">'
			 .'<label class="form_emf-choice">'
			 .'设为必选项'
			 .'</label>'
			 .'</div>'
			 .'</fieldset>'
			 .'</li>'
			 .'<li class="form_settings_li_right">'
			 .'<fieldset>'
			 .'<legend class="form_settings_group">字段显示</legend>'
			 .'<div class="form_fieldset_div">'
			 .'<input class="form_checkbox" type="radio" value="1" name="form['.$value['field_list'].'][show_field]" '.($value['show_field']==1?'checked':"").' />'
			 .'<label class="form_emf-choice">'
			 .'所有人'
			 .'</label>'
			 .'<br>'
			 .'<input class="form_checkbox" type="radio" value="2" name="form['.$value['field_list'].'][show_field]" '.($value['show_field']==2?'checked':'').' />'
			 .'<label class="form_emf-choice">'
			 .'仅自己'
			 .'</label>'
			 .'</div>'
			 .'</fieldset>'
			 .'</li>';
			 if($value['field_size'] == 'text'){
				 $config .= '<li style="float:left;">'
				 .'<label class="form_settings_label">'
				 .'字段长度'
				 .'</label>'
				 .'<input name="form['.$value['field_list'].'][field_size]" class="form_text" type="text" id="field_size" value="'.$value['field_size'].'" style="width:300px;" onchange="setValue(jQuery(this),\'field_size\',\''.$value['field_list'].'\');" />'
				 .'</li>';
			 }
			 if($value['field_type'] == 'textarea'){
				 $config .= '<li style="float:left;>'
				 .'<fieldset>'
				 .'<legend class="form_settings_group">字段长度</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;height:41px;">'
				 .'<div style="float:left;"><label class="form_emf-choice">'
				 .'列'
				 .'</label>'
				 .'<br>'
				 .'<input name="form['.$value['field_list'].'][field_cols]" type="text" value="'.$value['field_cols'].'" style="width:79px;" onchange="setValue(jQuery(this),\'range_min\',\''.$value['field_list'].'\');" />'
				 .'</div>'
				 .'<div style="float:left;margin-left:3px;"><label class="form_emf-choice">'
				 .'行'
				 .'</label>'
				 .'<br/>'
				 .'<input type="text" name="form['.$value['field_list'].'][field_rows]" value="'.$value['field_rows'].'" style="width:79px;" onchange="setValue(jQuery(this),\'range_max\',\''.$value['field_list'].'\');" />'
				 .'</div>'
				 .'</div>'
				 .'</fieldset>'
				 .'</li>';
			 }
			 if(in_array($value['field_type'],array('text','textarea'))){
				 $config .= '<li style="float:left;>'
				 .'<fieldset>'
				 .'<legend class="form_settings_group">范围</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;height:41px;">'
				 .'<div style="float:left;"><label class="form_emf-choice">'
				 .'下限'
				 .'</label>'
				 .'<br>'
				 .'<input name="form['.$value['field_list'].'][range_min]" type="text" value="'.$value['range_min'].'" style="width:79px;" onchange="setValue(jQuery(this),\'range_min\',\''.$value['field_list'].'\');" />'
				 .'</div>'
				 .'<div style="float:left;margin-left:3px;"><label class="form_emf-choice">'
				 .'上限'
				 .'</label>'
				 .'<br/>'
				 .'<input type="text" name="form['.$value['field_list'].'][range_max]" value="'.$value['range_max'].'" style="width:79px;" onchange="setValue(jQuery(this),\'range_max\',\''.$value['field_list'].'\');" />'
				 .'</div>'
				 .'</div>'
				 .'</fieldset>'
				 .'</li>';
			 }
			 if(in_array($value['field_type'],array('text','textarea'))){
				 $config .= '<li style="float:left;">'
				 .'<label class="form_settings_label">'
				 .'默认值'
				 .'</label>'
				 .'<input class="form_text" type="text" name="form['.$value['field_list'].'][default_value]" id="dafault_value" value="'.$value['default_value'].'" style="width:300px;" onkeyup="setValue(jQuery(this),\'default_value\',\''.$value['field_list'].'\');" />'
				 .'</li>';
			 }
			 if($value['field_type']=='radio'){
				 $data = unserialize($value['multiple_choice']);
				 $config .= '<li style="float:left;">'
				 .'<fieldset>'
				 .'<legend class="form_settings_group">选项</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;display:block;float:left;">'
				 .'<div style="float:left;">'
				 .'<ul>';
				 foreach($data AS $v){
					$config .= '<li style="float:left;">';
					if($value['multiple_choice_checked'] == $v){
						$config .= '<input type="checkbox" name="form['.$value['field_list'].'][multiple_choice_checked]" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'radio\',\''.$value['field_list'].'\');" checked />';
					}else{
						$config .= '<input type="checkbox" name="form['.$value['field_list'].'][multiple_choice_checked]" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'radio\',\''.$value['field_list'].'\');" />';
					}
					$config .= '<input name="form['.$value['field_list'].'][radio][]" type="text" value="'.$v.'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'multiple_choice\',\''.$value['field_list'].'\');" />'
					.'&nbsp;<img src="'.getUrl().'templates/zh/default/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\''.$value['field_type'].'\','.$value['field_list'].');"/>'
					.'&nbsp;<img src="'.getUrl().'templates/zh/default/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'.$value['field_list'].');"/></li>';
				 }
				 $config .= '</ul></div>'
				 .'</div>'
				 .'</fieldset>'
				 .'</li>';
			 }
			 if($value['field_type']=='checkbox'){
				 $data = unserialize($value['checkbox_choice']);
				 $checked = unserialize($value['checkbox_choice_checked']);
				 $config .= '<li style="float:left;">'
				 .'<fieldset>'
				 .'<legend class="form_settings_group">选项</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;display:block;float:left;">'
				 .'<div style="float:left;">'
				 .'<ul>';
				 foreach($data AS $k=>$v){
					$config .= '<li style="float:left;">';
					if(!$checked){
						$config .= '<input type="checkbox" name="form['.$value['field_list'].'][checkbox_choice_checked]['.$k.']" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'checkbox\',\''.$value['field_list'].'\');" />';
					}else{
						if(in_array($v,$checked)){
							$config .= '<input type="checkbox" name="form['.$value['field_list'].'][checkbox_choice_checked]['.$k.']" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'checkbox\',\''.$value['field_list'].'\');" checked />';
						}else{
							$config .= '<input type="checkbox" name="form['.$value['field_list'].'][checkbox_choice_checked]['.$k.']" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'checkbox\',\''.$value['field_list'].'\');" />';
						}
					}
					$config .= '<input name="form['.$value['field_list'].'][checkbox][]" type="text" value="'.$v.'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'checkbox_choice\',\''.$value['field_list'].'\');" />'
					.'&nbsp;<img src="'.getUrl().'templates/zh/default/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\''.$value['field_type'].'\','.$value['field_list'].');"/>'
					.'&nbsp;<img src="'.getUrl().'templates/zh/default/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'.$value['field_list'].');"/></li>';
				 }
				 $config .= '</ul></div>'
				 .'</div>'
				 .'</fieldset>'
				 .'</li>';
			 }
			 if($value['field_type']=='select'){
				 $data = unserialize($value['dropdown_choice']);
				 $config .= '<li style="float:left;">'
				 .'<fieldset>'
				 .'<legend class="form_settings_group">选项</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;display:block;float:left;">'
				 .'<div style="float:left;">'
				 .'<ul>';
				 foreach($data AS $v){
					$config .= '<li style="float:left;">';
					if($value['dropdown_choice_selected'] == $v){
						$config .= '<input type="radio" name="form['.$value['field_list'].'][dropdown_choice_selected]" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'select\',\''.$value['field_list'].'\');" checked />';
					}else{
						$config .= '<input type="radio" name="form['.$value['field_list'].'][dropdown_choice_selected]" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'select\',\''.$value['field_list'].'\');" />';
					}
					$config .= '<input name="form['.$value['field_list'].'][select][]" type="text" value="'.$v.'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'dropdown_choice\',\''.$value['field_list'].'\');" />'
					.'&nbsp;<img src="'.getUrl().'templates/zh/default/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\''.$value['field_type'].'\','.$value['field_list'].');"/>'
					.'&nbsp;<img src="'.getUrl().'templates/zh/default/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'.$value['field_list'].');"/></li>';
				 }
				 $config .= '</ul></div>'
				 .'</div>'
				 .'</fieldset>'
				 .'</li>';
			 }
			 $config .= '<li style="float:left;">'
			 .'<label class="form_settings_label">'
			 .'使用说明' 
			 .'</label>'
			 .'<textarea name="form['.$value['field_list'].'][instructions]" class="form_text" style="width:300px;height:70px;color:#333;">'.$value['instructions'].'</textarea>'
			 .'<input type="hidden" name="form['.$value['field_list'].'][field_type]" value="'.$value['field_type'].'" />'
			 .'<input type="hidden" name="form['.$value['field_list'].'][field_list]" value="'.$value['field_list'].'" />'
			 .'</li>'
			 .'<table id="form_emf-elements-operator-table" style="table-layout: fixed;">'
			 .'<tr>'
			 .'<td style="width:92px">'
			 .'<img src="'.getUrl().'templates/zh/default/images/duplicate.png" style="cursor: pointer;">'
			 .'</td>'
			 .'<td style="width:92px">'
			 .'<img src="'.getUrl().'templates/zh/default/images/delete.png" style="cursor: pointer;" onclick="del_li(event,jQuery(\'#'.$value['field_list'].' div\').last());return false;">'
			 .'</td>'
			 .'<td style="width:92px">'
			 .'<img src="'.getUrl().'templates/zh/default/images/add.png" style="cursor: pointer;" onclick="javascript:jQuery(\'#check1\').trigger(\'click\');"/>'
			 .'</td>'
			 .'</tr>'
			 .'</table>'
			 .'</ul>';
		}
		return $config;
	}
}
	
function getUserContentString($list){
	$str = '';
	if(!empty($list)){
		foreach($list AS $key=>$value){
			if($value['field_type'] == 'text'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span>'.($value['is_required']==1?'<span class="req"> * </span>':'').'</label>';
				$str .= '<div class="form_right_ic">';
				$str .= '<div class="form_span_y">';
				if($value['field_size']){
					$str .= '<input id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" class="text " type="text" size="'.$value['field_size'].'" value="'.$value['default_value'].'" readonly="readonly">';
				}else{
					$str .= '<input id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" class="text " type="text" value="'.$value['default_value'].'" readonly="readonly">';
				}
				$str .= '</div>';
				$str .= '</div>';
				$str .= '<div class="form_clear"></div>';
				$str .= '</div>';
				$str .= '<div style="z-index:1000;position:absolute;left:930px;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'textarea'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span>'.($value['is_required']==1?'<span class="req"> * </span>':'').'</label>';
				$str .= '<div class="form_right_ic">';
				$str .= '<div class="form_span_y">';
				$str .= '<textarea id="element_'.$value['field_list'].'" name="element_'.$value['field_list'].'" style="width:263px;height:157px;">'.$value['default_value'].'</textarea>';
				$str .= '</div>';
				$str .= '</div>';
				$str .= '<div class="form_clear"></div>';
				$str .= '</div>';
				$str .= '<div style="z-index:1000;position:absolute;left:1160px;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'radio'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span>'.($value['is_required']==1?'<span class="req"> * </span>':'').'</label>';
				$str .= '<div class="form_right_ic">';
				$str .= '<div class="form_span_y"><ul>';
				$data = unserialize($value['multiple_choice']);
				foreach($data AS $v){
					$str .= '<li style="float:left;width:200px;">';
					if($value['multiple_choice_checked'] == $v){
						$str .= '<input type="radio" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;" checked><span>'.$v.'</span>';
					}else{
						$str .= '<input type="radio" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;"><span>'.$v.'</span>';
					}
					$str .= '</li>';
				}
				$str .= '</ul></div>';
				$str .= '</div>';
				$str .= '<div class="form_clear"></div>';
				$str .= '</div>';
				$str .= '<div style="z-index:1000;position:absolute;left:930px;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'checkbox'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span>'.($value['is_required']==1?'<span class="req"> * </span>':'').'</label>';
				$str .= '<div class="form_right_ic">';
				$str .= '<div class="form_span_y"><ul>';
				$data = unserialize($value['checkbox_choice']);
				$checked = unserialize($value['checkbox_choice_checked']);
				foreach($data AS $k=>$v){
					$str .= '<li style="float:left;width:200px;">';
					if(!$checked){
						$str .= '<input type="checkbox" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;"><span>'.$v.'</span>';
					}else{
						if(in_array($v,$checked)){
							$str .= '<input type="checkbox" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;" checked><span>'.$v.'</span>';
						}else{
							$str .= '<input type="checkbox" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;"><span>'.$v.'</span>';
						}
					}
					$str .= '</li>';
				}
				$str .= '</ul></div>';
				$str .= '</div>';
				$str .= '<div class="form_clear"></div>';
				$str .= '</div>';
				$str .= '<div style="z-index:1000;position:absolute;left:930px;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'select'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span>'.($value['is_required']==1?'<span class="req"> * </span>':'').'</label>';
				$str .= '<div class="form_right_ic">';
				$str .= '<div class="form_span_y">';
				$str .= '<select name="element_'.$value['field_list'].'" onchange="javascript:return false;">';
				$data = unserialize($value['dropdown_choice']);
				foreach($data AS $v){
					if($value['dropdown_choice_selected'] == $v){
						$str .= '<option value="'.$v.'" selected>'.$v.'</option>';
					}else{
						$str .= '<option value="'.$v.'" >'.$v.'</option>';
					}
				}
				$str .= '</select></div>';
				$str .= '</div>';
				$str .= '<div class="form_clear"></div>';
				$str .= '</div>';
				$str .= '<div style="z-index:1000;position:absolute;left:930px;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}
		}
	}
	return $str;
}

function getIP() {
	$ip = getenv ( REMOTE_ADDR );
	$ip_ = getenv ( HTTP_X_FORWARDED_FOR );
	if (($ip_ != "") && ($ip_ != "unknown")){
		$ip = $ip_;
	}
	return $ip;
}

?>