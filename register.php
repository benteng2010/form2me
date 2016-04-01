<?php
#[会员注册]
require_once("global.php");
if($act == "regok")
{
	$username = SafeHtml($username);
	if(!$username)
	{
		Error($langs["reg_emptyuser"],"register.php");
	}
	$password = SafeHtml($password);
	$retypePassword = SafeHtml($retypePassword);
	if(!$password)
	{
		Error($langs["reg_emptypass"],"register.php");
	}
	if(!$retypePassword)
	{
		Error($langs["reg_emptychkpass"],"register.php");
	}
	if($password != $retypePassword)
	{
		Error($langs["reg_difpass"],"register.php");
	}
	$ContactEmail = SafeHtml($ContactEmail);
	if(!$ContactEmail)
	{
		Error($langs["reg_emptyemail"],"register.php");
	}
	if(!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$ContactEmail))
	{
		Error($langs["reg_erroremail"],"register.php");
	}
	$check_user = $DB->qgGetOne("SELECT * FROM ".$prefix."user WHERE user='".$username."'");
	if($check_user)
	{
		Error($langs["reg_user_exist"],"register.php");
	}
	$password = md5($password);
	$DB->qgInsert("INSERT INTO ".$prefix."user(user,pass,user_group,email,form_num,theme_num,regdate) VALUES('".$username."','".$password."','vistor','".$ContactEmail."','0','1','".$system_time."')");
	$id = $DB->qgInsertID();
	$msg = $DB->qgGetOne("SELECT * FROM theme_lists WHERE id=1 AND user_id=0");
	$DB->qgInsert("INSERT INTO theme_lists(user_id,subject,backgrounds,text,borders) VALUES('".$id."','default','".$msg['backgrounds']."','".$msg['text']."','".$msg['borders']."')");
	#[直接登录]
	$_SESSION["qg_sys_user"]["id"] = $id;
	$_SESSION["qg_sys_user"]["user"] = $username;
	$_SESSION["qg_sys_user"]["pass"] = $password;
	$_SESSION["qg_sys_user"]["email"] = $email;
	Error($langs["reg_ok"],"home.php");
}
else
{
	if(USER_STATUS == true)
	{
		Error($langs["reg_disabled"],"home.php");
	}
	#[标题头]
	$sitetitle = $langs["reg_title"]." - ".$system["sitename"];
	#[向导栏]
	$lead_menu[0]["url"] = "register.php";
	$lead_menu[0]["name"] = $langs["reg_title"];
	HEAD();
	FOOT("register");
}
?>