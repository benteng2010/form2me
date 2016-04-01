<?php
function chk_id($id,$url="",$msg="操作非法")
{
	$id = intval($id);
	if(!$id || $id == 0)
	{
		Error($msg,$url);
	}
	return true;
}
function Error($msg="操作错误",$url="",$time=1)
{
	global $TPL;
	if($url)
	{
		$TPL->set_var("errmsg",$msg);
		$TPL->set_var("url",$url);
		$TPL->set_var("time",$time);
		Foot("error.sys");
	}
	else
	{
		$TPL->set_var("errmsg",$msg);
		Foot("errmsg.sys");
	}
}

function Foot($tpl_file="")
{
	if(!$tpl_file)
	{
		die("操作错误....");
	}
	global $DB,$debug,$FS;
	global $TPL;
	$e = explode(" ",microtime());
	$e = $e[0] + $e[1];
	$time_used = round($e - STARTTIME,5);
	$debugmsg = "Processed in ".$time_used." second(s), ".@$DB->queryCount()." ".(@$DB->queryCount()>1 ? "queries" : "query").", ".intval(@$FS->readCount)." file(s)";
	$TPL->set_var("debug_msg",$debugmsg);
	
	$TPL->p($tpl_file);
	ob_end_flush();
	exit;
}

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

//function FckEditor($var="",$content="",$toolbar="",$height="",$width="100%"){
//	include("fckeditor/fckeditor_php5.php");
//	$oFCKeditor = new FCKeditor('FCKeditor1') ; // 创建FCKeditor实例
//$oFCKeditor->BasePath = './fckeditor/'; // 设置FCKeditor目录地址
//$FCKeditor->Width='100%'; //设置显示宽度
//$FCKeditor->Height='300px'; //设置显示高度的高度
// return $fck->CreateHtml(); // 创建编辑器
//
//}
function SafeHtml($msg = "")
{
	global $STR;
	return $STR->safe($msg);
}

function page($url,$total=0,$psize=30,$pageid=0,$halfPage=5)
{
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
	#[如果分页总数为1或0时，不显示]
	if($totalPage<2)
	{
		return false;
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
		$returnlist[$array_m]["name"] = "首页";
		$returnlist[$array_m]["status"] = 0;
		if($pageid > 1)
		{
			$array_m++;
			$returnlist[$array_m]["url"] = $url."&pageid=".($pageid-1);
			$returnlist[$array_m]["name"] = "上一页";
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
		$returnlist[$array_m]["name"] = "下一页";
		$returnlist[$array_m]["status"] = 0;
	}
	$array_m++;
	if($pageid != $totalPage)
	{
		$returnlist[$array_m]["url"] = $url."&pageid=".$totalPage;
		$returnlist[$array_m]["name"] = "最后一页";
		$returnlist[$array_m]["status"] = 0;
	}
	#[组织样式]
	$msg = "<table class='pagelist'><tr><td class='n'>".$total."/".$psize."</td>";
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
	$msg .= "<td><select onchange=\"qgurl('".$url."&pageid='+this.value)\">".implode("",$select_option)."</option></select></td>";
	$msg .= "</tr></table>";
	unset($returnlist);
	return $msg;
}

function CutString($string,$length=10,$dot="…")
{
	global $STR;
	return $STR->cut($string,$length,$dot);
}

function Utf2gb($utfstr)
{
	global $STR;
	return $STR->charset($utfstr,"UTF-8","GBK");
}

function gb2utf8($gbstr)
{
	global $STR;
	return $STR->charset($utfstr,"GBK","UTF-8");
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

function FckToHtml($msg)
{
	if(!$msg)
	{
		return false;
	}
	$url = GetSystemUrl();
	$msg = str_replace($url,"",$msg);
	$imgArray = array();
	preg_match_all("/src=[\"|'| ]((.*)\.(gif|jpg|jpeg|bmp|png|swf))/isU",$msg,$imgArray);
	$imgArray = array_unique($imgArray[1]);
	$count = count($imgArray);
	if($count < 1)
	{
		return $msg;
	}
	foreach($imgArray AS $key=>$value)
	{
		$value = trim($value);
		if(strpos($value,"http://") === false && $value)
		{
			$msg = str_replace($value,$url.$value,$msg);
		}
	}
	return $msg;
}

function FckHtml($msg="",$script=false,$iframe=false,$style=false)
{
	global $STR;
	$STR->set("script",$script);
	$STR->set("iframe",$iframe);
	$STR->set("style",$style);
	return $STR->html($msg);
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

function SetCheckCodes($codeType="admin")
{
	$x_size=90;
	$y_size=30;
	if(function_exists("imagecreate"))
	{
		$aimg = imagecreate($x_size,$y_size);
		$back = imagecolorallocate($aimg, 255, 255, 255);
		$border = imagecolorallocate($aimg, 0, 0, 0);
		imagefilledrectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $back);
		$txt="0123456789";
		$txtlen=strlen($txt);

		$thetxt="";
		for($i=0;$i<4;$i++)
		{
			$randnum=mt_rand(0,$txtlen-1);
			$randang=mt_rand(-20,20);	//文字旋转角度
			$rndtxt=substr($txt,$randnum,1);
			$thetxt.=$rndtxt;
			$rndx=mt_rand(2,7);
			$rndy=mt_rand(0,9);
			$colornum1=($rndx*$rndx*$randnum)%255;
			$colornum2=($rndy*$rndy*$randnum)%255;
			$colornum3=($rndx*$rndy*$randnum)%255;
			$newcolor=imagecolorallocate($aimg, $colornum1, $colornum2, $colornum3);
			imageString($aimg,5,$rndx+$i*21,5+$rndy,$rndtxt,$newcolor);
		}
		unset($txt);
		$thetxt = strtolower($thetxt);
		if ($codeType=="admin") 
		{	
			$_SESSION["qgLoginChk"] = md5($thetxt);#[写入session中]
		}elseif ($codeType=="user")
		{
			$_SESSION["userRegChk"] = md5($thetxt);#[写入session中这是给用户注册用的验证码]
		}elseif ($codeType=="form")
		{
			$_SESSION["userFormChk"] = md5($thetxt);#[写入session中这是给用户提交表单用的验证码]
		}
		imagerectangle($aimg, 0, 0, $x_size - 1, $y_size - 1, $border);

		$newcolor="";
		$newx="";
		$newy="";
		$pxsum=50;	//干扰像素个数
		for($i=0;$i<$pxsum;$i++)
		{
			$newcolor=imagecolorallocate($aimg, mt_rand(0,254), mt_rand(0,254), mt_rand(0,254));
			imagesetpixel($aimg,mt_rand(0,$x_size-1),mt_rand(0,$y_size-1),$newcolor);
		}
		header("Pragma:no-cache");
		header("Cache-control:no-cache");
		header("Content-type: image/png");
		imagepng($aimg);
		imagedestroy($aimg);
		exit;
	}
}

function csslist()
{
	global $FS;
	if(file_exists("data/style.txt"))
	{
		$style = $FS->qgRead("data/style.txt");#[读取样式]
	}
	else
	{
		$style = "||默认样式";
	}
	$style = str_replace("\r","",$style);
	$style_array = explode("\n",$style);
	$style_list = array();
	if(is_array($style_array))
	{
		foreach($style_array AS $key=>$value)
		{
			$value = trim($value);
			$m = explode("||",$value);
			$v = array();
			if($m[1])
			{
				$v["style"] = $m[0];
				$v["name"] = $m[1];
				$style_list[] = $v;
			}
		}
		return $style_list;
	}
	else
	{
		return false;
	}
}
function format_filesize($filesize = 0)
{
	global $STR;
	return $STR->num_format($filesize);
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

function getUrl()
{
	return 'http://localhost/form2me/';
}

function getUserContentConfig($list){
	$config = '';
	if(!empty($list)){
		foreach($list AS $key=>$value){
			 $config .= '<ul class="form_settings_ul" id="ul_'.$value['field_list'].'" style="display:none;">'
			 .'<li>'
			 .'<label class="form_settings_label">'
			 .'Field Label'
			 .'</label>'
			 .'<textarea name="form['.$value['field_list'].'][field_label]" class="form_text" style="width:100%;height:70px;color:#333;" onkeyup="setValue(jQuery(this),\'field_label\',\''.$value['field_list'].'\');">'.$value['field_label'].'</textarea>'
			 .'</li>'
			 .'<li class="form_settings_li_left">'
			 .'<fieldset>'
			 .'<legend class="form_settings_group">Options</legend>'
			 .'<div class="form_fieldset_div">'
			 .'<input class="form_checkbox" type="checkbox" value="1" name="form['.$value['field_list'].'][is_required]" '.($value['is_required']==1?'checked':'').' onchange="setRequire(jQuery(this),\''.$value['field_list'].'\');">'
			 .'<label class="form_emf-choice">'
			 .'Required'
			 .'</label>'
			 .'</div>'
			 .'</fieldset>'
			 .'</li>'
			 .'<li class="form_settings_li_right">'
			 .'<fieldset>'
			 .'<legend class="form_settings_group">Show Field to</legend>'
			 .'<div class="form_fieldset_div">'
			 .'<input class="form_checkbox" type="radio" value="1" name="form['.$value['field_list'].'][show_field]" '.($value['show_field']==1?'checked':"").' />'
			 .'<label class="form_emf-choice">'
			 .'Everyone'
			 .'</label>'
			 .'<br>'
			 .'<input class="form_checkbox" type="radio" value="2" name="form['.$value['field_list'].'][show_field]" '.($value['show_field']==2?'checked':'').' />'
			 .'<label class="form_emf-choice">'
			 .'Admin Only'
			 .'</label>'
			 .'</div>'
			 .'</fieldset>'
			 .'</li>';
			 if($value['field_size'] == 'text'){
				 $config .= '<li style="float:left;">'
				 .'<label class="form_settings_label">'
				 .'Field Size'
				 .'</label>'
				 .'<input name="form['.$value['field_list'].'][field_size]" class="form_text" type="text" id="field_size" value="'.$value['field_size'].'" style="width:300px;" onchange="setValue(jQuery(this),\'field_size\',\''.$value['field_list'].'\');" />'
				 .'</li>';
			 }
			 if($value['field_type'] == 'textarea'){
				 $config .= '<li style="float:left;>'
				 .'<fieldset>'
				 .'<legend class="form_settings_group">Field Size</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;height:41px;">'
				 .'<div style="float:left;"><label class="form_emf-choice">'
				 .'Cols'
				 .'</label>'
				 .'<br>'
				 .'<input name="form['.$value['field_list'].'][field_cols]" type="text" value="'.$value['field_cols'].'" style="width:79px;" onchange="setValue(jQuery(this),\'range_min\',\''.$value['field_list'].'\');" />'
				 .'</div>'
				 .'<div style="float:left;margin-left:3px;"><label class="form_emf-choice">'
				 .'Rows'
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
				 .'<legend class="form_settings_group">Range</legend>'
				 .'<div class="form_fieldset_div_2" style="background-color: #AFDAE8;height:41px;">'
				 .'<div style="float:left;"><label class="form_emf-choice">'
				 .'Range Min'
				 .'</label>'
				 .'<br>'
				 .'<input name="form['.$value['field_list'].'][range_min]" type="text" value="'.$value['range_min'].'" style="width:79px;" onchange="setValue(jQuery(this),\'range_min\',\''.$value['field_list'].'\');" />'
				 .'</div>'
				 .'<div style="float:left;margin-left:3px;"><label class="form_emf-choice">'
				 .'Range Max'
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
				 .'Default Value'
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
						$config .= '<input type="radio" name="form['.$value['field_list'].'][multiple_choice_checked]" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'radio\',\''.$value['field_list'].'\');" checked />';
					}else{
						$config .= '<input type="radio" name="form['.$value['field_list'].'][multiple_choice_checked]" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'radio\',\''.$value['field_list'].'\');" />';
					}
					$config .= '<input name="form['.$value['field_list'].'][radio][]" type="text" value="'.$v.'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'multiple_choice\',\''.$value['field_list'].'\');" />'
					.'&nbsp;<img src="'.getUrl().'admin/tpl/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\''.$value['field_type'].'\','.$value['field_list'].');"/>'
					.'&nbsp;<img src="'.getUrl().'admin/tpl/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'.$value['field_list'].');"/></li>';
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
					if(in_array($v,$checked)){
						$config .= '<input type="checkbox" name="form['.$value['field_list'].'][checkbox_choice_checked]['.$k.']" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'checkbox\',\''.$value['field_list'].'\');" checked />';
					}else{
						$config .= '<input type="checkbox" name="form['.$value['field_list'].'][checkbox_choice_checked]['.$k.']" value="'.$v.'" onclick="set_default_choice(jQuery(this),\'checkbox\',\''.$value['field_list'].'\');" />';
					}
					$config .= '<input name="form['.$value['field_list'].'][checkbox][]" type="text" value="'.$v.'" style="width:190px;" maxlength="100" onkeyup="setValue(jQuery(this),\'checkbox_choice\',\''.$value['field_list'].'\');" />'
					.'&nbsp;<img src="'.getUrl().'admin/tpl/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\''.$value['field_type'].'\','.$value['field_list'].');"/>'
					.'&nbsp;<img src="'.getUrl().'admin/tpl/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'.$value['field_list'].');"/></li>';
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
					.'&nbsp;<img src="'.getUrl().'admin/tpl/images/form-element-option-add.png" onclick="insert_choice(jQuery(this),\''.$value['field_type'].'\','.$value['field_list'].');"/>'
					.'&nbsp;<img src="'.getUrl().'admin/tpl/images/form-element-option-delete.png" onclick="delete_choice(jQuery(this),'.$value['field_list'].');"/></li>';
				 }
				 $config .= '</ul></div>'
				 .'</div>'
				 .'</fieldset>'
				 .'</li>';
			 }
			 $config .= '<li style="float:left;">'
			 .'<label class="form_settings_label">'
			 .'Instructions for User' 
			 .'</label>'
			 .'<textarea name="form['.$value['field_list'].'][instructions]" class="form_text" style="width:300px;height:70px;color:#333;">'.$value['instructions'].'</textarea>'
			 .'<input type="hidden" name="form['.$value['field_list'].'][field_type]" value="'.$value['field_type'].'" />'
			 .'<input type="hidden" name="form['.$value['field_list'].'][field_list]" value="'.$value['field_list'].'" />'
			 .'</li>'
			 .'<table id="form_emf-elements-operator-table" style="table-layout: fixed;">'
			 .'<tr>'
			 .'<td style="width:92px">'
			 .'<img src="'.getUrl().'admin/tpl/images/duplicate.png" style="cursor: pointer;">'
			 .'</td>'
			 .'<td style="width:92px">'
			 .'<img src="'.getUrl().'admin/tpl/images/delete.png" style="cursor: pointer;" onclick="del_li(event,jQuery(\'#'.$value['field_list'].' div\').last());return false;">'
			 .'</td>'
			 .'<td style="width:92px">'
			 .'<img src="'.getUrl().'admin/tpl/images/add.png" style="cursor: pointer;" onclick="javascript:jQuery(\'#check1\').trigger(\'click\');"/>'
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
				$str .= '<div style="z-index:1000;position:absolute;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
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
				$str .= '<div style="z-index:1000;position:absolute;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'radio'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span></label>';
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
				$str .= '<div style="z-index:1000;position:absolute;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'checkbox'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span></label>';
				$str .= '<div class="form_right_ic">';
				$str .= '<div class="form_span_y"><ul>';
				$data = unserialize($value['checkbox_choice']);
				$checked = unserialize($value['checkbox_choice_checked']);
				foreach($data AS $k=>$v){
					$str .= '<li style="float:left;width:200px;">';
					if(in_array($v,$checked)){
						$str .= '<input type="checkbox" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;" checked><span>'.$v.'</span>';
					}else{
						$str .= '<input type="checkbox" name="element_'.$value['field_list'].'" value="'.$v.'" onclick="javascript:return false;"><span>'.$v.'</span>';
					}
					$str .= '</li>';
				}
				$str .= '</ul></div>';
				$str .= '</div>';
				$str .= '<div class="form_clear"></div>';
				$str .= '</div>';
				$str .= '<div style="z-index:1000;position:absolute;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}elseif($value['field_type'] == 'select'){
				$str .= '<li id="'.$value['field_list'].'">';
				$str .= '<a href="#" class="form_widget_container" onmouseover="javascript:jQuery(\'div\',this).last().show();" onmouseout="javascript:jQuery(\'div\',this).last().hide();" onclick="getSetOptions(jQuery(this),\''.$value['field_list'].'\');">';
				$str .= '<div class="form_field">';
				$str .= '<label class="form_label"><span class="form_label_title">'.$value['field_label'].'</span></label>';
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
				$str .= '<div style="z-index:1000;position:absolute;display:none;" onclick="del_li(event,jQuery(this));return false;"><img src="'.getUrl().'templates/zh/default/images/form-element-delete.png"/></div>';
				$str .= '</a>';
				$str .= '</li>';
			}
		}
	}
	return $str;
}

?>