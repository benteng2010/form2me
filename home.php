<?php
#[网站首页]
require_once("global.php");

$lead_status = false;
#[定义头部信息]
$sitetitle = $system["sitename"];

if(!USER_STATUS){
	header('Location:login.php');
}else{
	header('Location:formManage.php');
}

?>