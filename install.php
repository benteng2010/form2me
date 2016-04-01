<?php
header("Content-type: text/html; charset=utf8");
error_reporting(0);
ob_start();
$magic_quotes_gpc = get_magic_quotes_gpc();
@extract(daddslashes($_POST));
@extract(daddslashes($_GET));

define("HR","<hr color='#D4D4D4' size='1' />");

function daddslashes($string, $force = 0)
{
	if(!$GLOBALS["magic_quotes_gpc"] || $force)
	{
		if(is_array($string))
		{
			foreach($string as $key => $val)
			{
				$string[$key] = daddslashes($val, $force);
			}
		}
		else
		{
			$string = addslashes($string);
		}
	}
	return $string;
}

Function format_sql($sql)
{
	global $DB;
	$sql = str_replace("\r","\n",$sql);
	$ret = array();
	$num = 0;
	foreach(explode(";\n", trim($sql)) as $query) {
		$queries = explode("\n", trim($query));
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == '#' || $query[0].$query[1] == '--' ? '' : $query;
		}
		$num++;
	}
	unset($sql);

	foreach($ret as $query) {
		$query = trim($query);
		if($query) {
			if(substr($query, 0, 12) == 'CREATE TABLE') {
				$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);
				//echo '创建表：'.$name.' ... <font color="#0000EE">'.$lang['succeed'].'</font><br>';
				$DB->qgQuery(create_table($query));
			} else {
				$DB->qgQuery($query);
			}
		}
	}
}

function create_table($sql)
{
	return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql).(mysql_get_server_info() > '4.1' ? " ENGINE=MyISAM DEFAULT CHARSET=utf8" : " TYPE=MYISAM");
}

function install_head($title="")
{
	echo "<html>\n";
	echo "<head>\n";
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n";
	echo "<title>";
	if($title)
	{
		echo $title." - ";
	}
	echo "欢迎安装GOOTOP-CMS网站平台系统";
	echo "</title>\n";
	echo "<style type='text/css'>\nbody,table,tr,td,div{font:normal 12px Tahoma,Arial,宋体;margin:0px;padding:0px;}\n";
	echo "</style>\n";
	echo "</head>";
	echo "<body><br /><br /><br /><br /><br /><br />";
}

function install_foot()
{
	echo "</body>\n";
	echo "</html>";
	ob_end_flush();
	exit;
}

function echo_msg($left="",$right="",$mouse=false)
{
	$mouse = $mouse ? " onmouseover=\"this.style.backgroundColor='#EEEEEE'\" onmouseout=\"this.style.backgroundColor=''\"" : "";
	echo "<div".$mouse.">\n";
	echo "<table width='100%' cellpadding='0' cellspacing='0'>\n";
	echo "<tr>\n";
	if($right)
	{
		echo "<td width='220px' align='right' height='30px'>&nbsp;".$left."</td>\n";
		echo "<td>".$right."</td>";
	}
	else
	{
		echo "<td align='center'>".$left."</td>";
	}
	echo "</tr>";
	echo "</table>";
	echo "</div>";
}

function echo_start()
{
	echo "<div align='center'>";
	echo "<div style='border:1px #D4D4D4 solid;width:550px;padding:5px;'>";
}

function echo_end()
{
	echo "</div>";
}

function form_start($url="")
{
	echo "<script type='text/javascript'>\n";
	echo "function chkalert()\n{\n\tq=confirm('请检查信息是否填写正确，按“确定”继续，按“取消”返回');\n";
	echo "\tif(q == '0')\n\t{\n\t\treturn false;\n\t}\n}\n";
	echo "</script>\n";
	echo "<div style='display:none;'><form method='post' action='".$url."' onsubmit='return chkalert();'></div>";
}

function form_end()
{
	echo "<div style='display:none;'></form></div>";
}

function button($type="button",$value="下一步")
{
	if($type == "submit")
	{
		$button = "<input type='submit' value='".$value."'>";
	}
	else
	{
		$button = "<script type='text/javascript'>\nfunction tourl(id)\n{\nwindow.location.href='install.php?act='+id;\n}\n</script>\n";
		$button .= "<input type='button' value='".$value."' onclick=\"tourl('".$type."')\">";
	}
	return $button;
}

function safe_html($msg = "")
{
	if(empty($msg))
	{
		return false;
	}
	$msg = str_replace('&amp;','&',$msg);
	$msg = str_replace('&nbsp;',' ',$msg);
	$msg = str_replace("'","&#39;",$msg);
	$msg = str_replace('"',"&quot;",$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);
	$msg = str_replace("\t","&nbsp; &nbsp; ",$msg);
	$msg = str_replace("\r","",$msg);
	$msg = str_replace("   ","&nbsp; &nbsp;",$msg);
	return $msg;
}

function check_write($file)
{
	if(is_writeable($file))
	{
		return "<span style='color:darkgreen;font:bold 15px Tahoma,Arial;'>√</span>";
	}
	else
	{
		return "<span style='color:red;font:bold 15px Tahoma,Arial;'>×</span>";
	}
}

function error($title,$return_act="install.php",$button_name="返回上一步")
{
	install_head("友情提示");
	echo_start();
	echo_msg("<br /><br /><br /><span style='font-size:17px;'>".$title."</span><br /><br /><br />");
	echo_msg(button($return_act,$button_name)."<br /><br /><br />");
	echo_end();
	install_foot();
}

function getip()
{
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
	{
		$onlineip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
	{
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
	{
		$onlineip = getenv('REMOTE_ADDR');
	}
	elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
	{
		$onlineip = $_SERVER['REMOTE_ADDR'];
	}
	return $onlineip;
}

$sysact = $_GET["act"];

if(file_exists("data/lock.php") && $sysact != "toindex")
{
	install_head("安装程序已被锁定");
	echo_start();
	echo_msg("GOOTOP-CMS已经安装完成，如果您要重新安装，请先删除文件data/lock.php");
	echo_end();
	install_foot();
}


if(!$sysact)
{
	install_head();
	echo_start();
	echo_msg("欢迎您安装GOOTOP-CMS网站平台系统".HR);
	echo_msg("检查属性是否可写：",check_write("./")." 根目录");
	echo_msg("",check_write("data")." data 文本数据目录");
	echo_msg("",check_write("data/admin_tplc")." data/admin_tplc 后台模板编译目录");
	echo_msg("",check_write("data/cache")." data/cache 目录");
	echo_msg("",check_write("data/phpok_tplc")." data/phpok_tplc 前台模板编译目录");
	echo_msg("",check_write("data/session")." data/session SESSION存放目录");
	echo_msg("",check_write("data/sqlback")." data/sqlback 数据库备份目录");
	echo_msg("",check_write("upfiles")." upfiles 上传附件目录");
	echo_msg("",check_write("upfiles/xu_temp")." data/xu_temp XUploadFile控件上传临时目录");
	echo_msg("",check_write("upfiles/xu_temp_")." data/xu_temp_ XUploadFile控件上传缓存目录");
	if(file_exists("config.php"))
	{
		echo_msg("",check_write("config.php")." config.php 配置文件");
	}
	if(file_exists(".htaccess"))
	{
		echo_msg("",check_write(".htaccess")." .htaccess 伪静态页文件");
	}
	echo_msg(HR."<span style='color:red;'>友情提示：</span>程序检查可能不全面，建议手动检查");
	echo_msg(HR.button("selectdb"));
	echo_end();
	install_foot();
}
elseif($sysact=='selectdb'){
	install_head("选择数据库类型");
	echo_start();
	echo_msg("选择数据库类型".HR);
	echo_msg("<input type=button value=mysql数据库   onclick=\"javascript:window.location.href='install.php?act=setconfig&dbtype=mysql'\"/><input type=button value=sqlite数据库   onclick=\"javascript:window.location.href='install.php?act=setconfig&dbtype=sqlite'\"/>");
	echo_end();
}
elseif($sysact == "setconfig")
{
	$dbtype=$_REQUEST['dbtype'];
	install_head(strtoupper($dbtype)."数据库,配置config.php文件");
	echo_start();
	echo_msg(strtoupper($dbtype)."数据库,配置config.php文件信息".HR);
	form_start("install.php?act=setconfig_ok&dbtype={$dbtype}");
	if($dbtype=='mysql'){
		echo_msg("服务器地址：","<input type='text' name='db_host' value='localhost'>",true);
		echo_msg("","[虚拟空间请使用 127.0.0.1]");
		echo_msg("数据库端口：","<input type='text' name='db_port' value='3306' style='width:45px;'>",true);
		echo_msg("数据库账号：","<input type='text' name='db_user' value='root'>",true);
		echo_msg("数据库密码：","<input type='text' name='db_pass'>",true);
		echo_msg("数据库名称：","<input type='text' name='db_data'> [请确保存在数据库]",true);
		}elseif($dbtype=='sqlite'){
			echo_msg("使用默认数据文件:<input type=radio name=defaultdb value=0 checked />   上传数据文件:(未实现)");
		}
		echo_msg(HR);
		echo_msg("数据表前缀：","<input type='text' name='prefix' value='qinggan_'>",true);
		echo_msg("后台启用验证码：","<input type='radio' name='ischeck' value='1' checked>启用 <input type='radio' name='ischeck' value='0'>禁用 [建议使用，要求空间支持GD库函数]",true);
		echo "<input type='hidden' name='urlrewrite' value='0'>";
		echo_msg(HR.button("submit","下一步"));
		echo_end();
		form_end();
		install_foot();
}
elseif($sysact == "setconfig_ok")
{
	$ischeck = intval($ischeck) ? "true" : "false";
	$urlrewrite = intval($urlrewrite) ? "true" : "false";
	$session = safe_html($session);
	if($dbtype=='mysql'){
	$db_host = safe_html($db_host);
	$db_port = safe_html($db_port);
	if(!$db_port)
	{
		$db_port = "3306";
	}
	if($db_port != "3306")
	{
		$db_host = $db_host.":".$db_port;
	}
	$db_user = safe_html($db_user);
	$db_pass = safe_html($db_pass);
	$db_data = safe_html($db_data);
	if(!$db_data)
	{
		error("数据库名称不允许为空","setconfig&dbtype={$dbtype}");
	}
	$prefix = safe_html($prefix) ? safe_html($prefix) : "qinggan_";
	if(substr($prefix,-1) != "_")
	{
		$prefix .= "_";
	}
//	$ischeck = intval($ischeck) ? "true" : "false";
//	$urlrewrite = intval($urlrewrite) ? "true" : "false";
//	$session = safe_html($session);
	if($session && !is_writeable($session))
	{
		error("SESSION目录不允许写入，请检查","setconfig");
	}
	if($urlrewrite == "true")
	{
		#[如果伪静态页文件不存在的话]
		if(!file_exists(".htaccess"))
		{
			@touch(".htaccess");
		}
		if(!is_writeable(".htaccess"))
		{
			error("伪静态页配置文件.htaccess不允许写入，请返回禁用或检查配置文件","setconfig");
		}
	}
	#[检测数据库能否连接得上]
	$chk_conn = mysql_connect($db_host,$db_user,$db_pass);
	if(!$chk_conn)
	{
		error("无法连接到数据库上，请检查配置是否正确...","setconfig");
	}
	#[检测数据库是否存在]
	$chk_data = mysql_select_db($db_data);
	if(!$chk_data)
	{
		error("没有找到数据库，请检查该数据库是否存在...","setconfig");
	}
	#[写入信息]
	$msg = "<?"."php\n";
	$msg.= "#[数据库类型]\n";
	$msg.= "\$dbType = \"".$dbtype."\";\n\n";
	$msg.= "#[数据库信息]\n";
	$msg.= "\$dbHost = \"".$db_host."\";\n";
	$msg.= "\$dbUser = \"".$db_user."\";\n";
	$msg.= "\$dbPass = \"".$db_pass."\";\n";
	$msg.= "\$dbData = \"".$db_data."\";\n";
	$msg.= "\n#[数据表前缀]\n";
	$msg.= "\$prefix = \"".$prefix."\";\n";
	$msg.= "\n#[是否启用调试]\n";
	$msg.= "\$viewbug = 0;\n";
	$msg.= "\n#[是否启用伪静态页功能，使用为true，不使用为false]\n";
	$msg.= "\$urlRewrite = ".$urlrewrite.";\n";
	$msg.= "\n#[后台是否启用验证码功能，使用为true，不使用为false]\n";
	$msg.= "\$isCheckCode = ".$ischeck.";\n";
	#$msg.= "\n#[设置SESSION存放目录，建议使用data/session目录]\n";
	#$msg.= "\$session_folder = \"".$session."\";\n";
	$msg.= "?>";
	}elseif($dbtype=='sqlite'){
		
			$msg = "<?"."php\n";
			$msg.= "#[数据库类型]\n";
			$msg.= "\$dbType = \"".$dbtype."\";\n\n";
			$msg.= "#[数据库信息]\n";
			$msg.= "\n#[数据表前缀]\n";
			$msg.= "\$prefix = \"".$prefix."\";\n";
			if($defaultdb==0){
				$msg.= "\$dbName =\"db/gootopcms.db\";\n";
			}elseif($defaultdb==1){
				
			}
			$msg.= "\n#[是否启用调试]\n";
			$msg.= "\$viewbug = 0;\n";
			$msg.= "\n#[是否启用伪静态页功能，使用为true，不使用为false]\n";
			$msg.= "\$urlRewrite = ".$urlrewrite.";\n";
			$msg.= "\n#[后台是否启用验证码功能，使用为true，不使用为false]\n";
			$msg.= "\$isCheckCode = ".$ischeck.";\n";
			#$msg.= "\n#[设置SESSION存放目录，建议使用data/session目录]\n";
			#$msg.= "\$session_folder = \"".$session."\";\n";
			$msg.= "?>";
	}
	$handle = fopen("config.php","wb");
	fwrite($handle,trim($msg));
	fclose($handle);
	if($dbtype=='mysql'){
		error("config.php信息已经配置成功！","incsql&dbtype={$dbtype}","下一步");
	}elseif($dbtype=='sqlite'){
		error("config.php信息已经配置成功！","admin&dbtype={$dbtype}","下一步");
	}
}
elseif($sysact == "incsql")
{
	if(!file_exists("config.php"))
	{
		error("config.php配置文件不存在，请返回修改","setconfig","设置config.php文件");
	}
	if(!file_exists("install.sql"))
	{
		error("install.sql 文件不存在，请上传...","incsql","下一步");
	}
	include_once("config.php");
	include_once("class/mysql.db.class.php");
	$DB = new MySql($dbHost,$dbData,$dbUser,$dbPass);
	$sql = file_get_contents("install.sql");
	if($prefix != "qinggan_")
	{
		$sql = str_replace("qinggan_",$prefix,$sql);
	}
	format_sql($sql);#[导入数据]
	unset($sql);
	#[这里是系统会向谷铂官方发送一条安装信息，这里信息是安全的，不会收集账号和密码，仅用于统计]
	#[如果是本地安装或纯IP安装时是不会发送的]
	$http_host = strtolower($_SERVER["HTTP_HOST"]);
	$http_ip = strtolower($_SERVER["REMOTE_ADDR"]);
	$DB->qgClose();#[关闭数据库]
	if($http_host != "localhost" && $http_ip != "127.0.0.1" && $http_host != $http_ip)
	{
		@ini_set("mysql.connect_timeout","5");
		$conn = mysql_connect("127.0.0.1","system_insert","system_insert");
		if($conn)
		{
			mysql_query("SET NAMES 'utf8'",$conn);
			mysql_query("SET sql_mode=''",$conn);
			$m = mysql_select_db("phpok_com");
			if($m)
			{
				#[客户端IP]
				$clientip = getip();
				$time = time();
				#[写入数据库]
				$query = mysql_query("SELECT * FROM qinggan_whouse WHERE site='".$http_host."'");
				$rs = mysql_fetch_array($query,$conn);
				if(!$rs)
				{
					mysql_query("INSERT INTO qinggan_whouse(site,ip,postdate) VALUES('".$http_host."','".$clientip."','".$time."')");
				}
			}
		}
	}
	error("数据表信息已成功导入，下一步管理员设置","admin&dbtype={$dbtype}","下一步");
}
elseif($sysact == "admin")
{
	install_head("设置管理员账号密码");
	echo_start();
	echo_msg("设置管理员账号密码".HR);
	form_start("install.php?act=admin_ok&dbtype={$dbtype}");
	echo_msg("管理员账号：","<input type='text' name='user' value='admin'>",true);
	echo_msg("管理员密码：","<input type='text' name='pass' value='admin'>",true);
	echo_msg("管理员邮箱：","<input type='text' name='email' value='admin@admin.com'>",true);
	echo_msg(HR);
	echo_msg(button("submit","下一步"));
	echo_end();
	form_end();
	install_foot();
}
elseif($sysact == "admin_ok")
{
	$user = safe_html($user);
	$pass = safe_html($pass);
	$email = safe_html($email);
	if(!$user)
	{
		error("管理员账号不能为空","admin");
	}
	if(!$pass)
	{
		error("管理员密码不能为空","admin");
	}
	if(!file_exists("config.php"))
	{
		error("config.php配置文件不存在，请返回修改","setconfig","设置config.php文件");
	}
if($dbtype=='mysql'){
	if(!file_exists("install.sql"))
	{
		error("install.sql 文件不存在，请上传...","incsql","下一步");
	}
}
	include_once("config.php");
if($dbtype=='mysql'){
	include_once("class/mysql.db.class.php");
	$DB = new MySql($dbHost,$dbData,$dbUser,$dbPass);
	$DB->qgQuery("TRUNCATE TABLE `".$prefix."admin`");
	$sql = "INSERT INTO ".$prefix."admin(typer,user,pass,email) VALUES('system','".$user."','".md5($pass)."','".$email."')";
	$DB->qgQuery($sql);
}elseif($dbtype=='sqlite'){
	include_once("class/sqlite.db.class.php");
	$DBs = new Sqlite($dbName);
	$sql="delete from qinggan_admin";
	$DBs->Query($sql);
	$sql = "INSERT INTO ".$prefix."admin(typer,user,pass,email) VALUES('system','".$user."','".md5($pass)."','".$email."')";
	$DBs->Query($sql);
}
	error("管理员设置成功","setlock","下一步");
}
elseif($sysact == "setlock")
{
	@touch("data/lock.php");
	error("恭喜您，GOOTOP-CMS网站平台程序已安装成功<br /><br />感谢您使用GOOTOP-CMS网站平台程序，祝您事业进步，万事顺心！","toindex","进入首页");
}
elseif($sysact == "toindex")
{
	ob_end_clean();
	header("Location:index.php");
}
?>