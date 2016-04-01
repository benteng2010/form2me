<?php
#[设置程序版本]
#[注意，请不要更改该文件里的信息，该文件用于版本较检]

#[限制直接从文件中访问]
if(!defined("PHPOK_SET"))
{
	exit("Access Denied");
}
#[本版本加入了phpok支持sqlite文件型数据库]
define("VERSION","2.21");
?>