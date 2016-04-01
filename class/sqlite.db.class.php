<?php
#----------------Sqlite类------------------
class Sqlite {
	var $link;
	var $querynum = 0;
	var $debug=true;
	var $result;
	function Sqlite($dbname){
		$this->Open($dbname);
	}
	function __construct($dbname){
		$this->Sqlite($dbname);
	}
/*连接Sqlite数据库，参数：dbname->数据库名字*/
	function Open($dbname) 
	{
		if(!($this->link = @sqlite_open($dbname))) 
		{
			$this->halt('Can not Open to Sqlite');
		}
	}

/*执行sql语句，返回对应的结果标识*/
function Query($sql) {
	$this->querynum++;
	if($query = @sqlite_query($this->link, $sql)) {
		$this->result=$query;
		return $query;
	} else {
		$this->halt('Sqlite Query Error', $sql);
	}
}

/*执行Insert Into语句，并返回最后的insert操作所产生的自动增长的id*/
function Insert($sql='') {
	$this->Query($sql);
	return sqlite_last_insert_rowid($this->link);
}

/*执行Update语句，并返回最后的update操作所影响的行数*/
function Update($table, $uarr, $condition = '') {
	$value = $this->UpdateSql($uarr);
	
	if ($condition) {
		$condition = ' WHERE ' . $condition;
	}
	
	$this->Query('UPDATE "' . $table . '"' . ' SET ' . $value . $condition);
	return sqlite_changes($this->link);
}

/*执行Delete语句，并返回最后的Delete操作所影响的行数*/
function Delete($table, $condition = '') {
	if ($condition) {
		$condition = ' WHERE ' . $condition;
	}
	$this->Query('DELETE "' . $table . '"' . $condition);
	
	return sqlite_changes($this->link);
}

/*将字符转为可以安全保存的sqlite值，比如a'a转为a''a*/
/*
function EnCode($str) {
if (strpos($str, "\0") === false) {
if (strpos($str, '\'') === false) {
return $str;
} else {
return str_replace('\'', '\'\'', $str);
}
} else {
$str = str_replace("\0", '', $str);
if (strpos($str, '\'') === false) {
return $str;
} else {
return str_replace('\'', '\'\'', $str);
}
}
}
*/
function EnCode($str) {
	return sqlite_escape_string($str);
}

/*将可以安全保存的sqlite值转为正常的值，比如a''a转为a'a*/
function DeCode($str) {
	if (strpos($str, '\'\'') === false) {
		return $str;
	}else {
		return str_replace('\'\'', '\'', $str);
	}
}

/*将对应的列和值生成对应的insert语句，如：array('id' => 1, 'name' => 'name')返回("id", "name") VALUES (1, 'name')*/
function InsertSql($iarr) {
	if (is_array($iarr)) {
		$fstr = '';
		$vstr = '';
		foreach ($iarr as $key => $val) {
			$fstr .= '"' . $key . '", ';
			$vstr .= '\'' . $val . '\', ';
		}
		
		if ($fstr) {
			$fstr = '(' . substr($fstr, 0, -2) . ')';
			$vstr = '(' . substr($vstr, 0, -2) . ')';
			return $fstr . ' VALUES ' . $vstr;
		} else {
			return '';
		}
	} else {
		return '';
	}
}

/*将对应的列和值生成对应的insert语句，如：array('id' => 1, 'name' => 'name')返回"id" = 1, "name" = 'name'*/
function UpdateSql($uarr) {
	if (is_array($uarr)) {
		$ustr = '';
		foreach ($uarr as $key => $val) {
			$ustr .= '"' . $key . '" = \'' . $val . '\', ';
		}
		
		if ($ustr) {
			return substr($ustr, 0, -2);
		} else {
			return '';
		}
	} else {
		return '';
	}
}

/*返回对应的查询标识的结果的一行*/
function GetRow($query, $result_type = SQLITE_ASSOC) {
	$query=$this->Query($query);
	return sqlite_fetch_array($query, $result_type);
}

/*清空查询结果所占用的内存资源*/
function Clear($query) {
	$query = null;
	return true;
}

/*关闭数据库*/
function Close() {
	return sqlite_close($this->link);
}

function halt($message = '', $sql = '') {
	$ei = sqlite_last_error($this->link);
	$message .= '<br />Sqlite Error: ' . $ei . ', ' . sqlite_error_string($ei);
	if ($sql) {
		$sql = '<br />sql:' . $sql;
	}
	if($this->debug)
	{//exit('DataBase Error.<br />Message: ' . $message . $sql);
	}
	}
	
//------------------------
#获得一行
	function qgGetOne($sql='')
	{ 
		if($sql){
			$rs=$this->GetRow($sql);
		}else{
			$rs=$this->result;
		}
	  return $rs;
	}

	function qgInsertID($sql='')
	{
		if($sql)
		{
			$rs=$this->qgGetOne($sql);
			return $rs;
		}else{
			return sqlite_last_insert_rowid();
		}	
			
	}
	
	function qgInsert($sql='')
	{
	 	$rs=$this->Insert($sql);
	 	return $rs;
		
	}
		
	
	function qgGetAll($sql='',$nocache=false){ 
	$result=$this->Query($sql);
		$rs=array();
		while ($row=sqlite_fetch_array($this->result)) {
			
				$rs[]=$row;
				
		}
		
		return $rs;
		
	}
	
	function queryCount(){
			
		return $this->querynum;
		
	}
	
	function qgCount($sql=''){
		if($sql){
			$rs=$this->Query($sql);
			unset($sql);
		}
		$rsC=sqlite_num_rows($this->result);	
		return $rsC;	
	}
	
	function qgQuery($sql='')
	{ 
		return $this->Query($sql);
			
	}
	
	function qg_count($sql='')
	{
		if($sql)
		{
			$this->Query($sql);
			$rs=$this->qgGetOne();
			$rs=sqlite_fetch_array($rs);
			return $rs[0];
		}
		else
		{
			return sqlite_num_rows($this->result);
		}
		
	}
	
#取得结果集中字段数
	function qgNumFields($sql = ""){
		
		if($sql)
		{
			$this->Query($sql);
		}
		return sqlite_num_fields($this->result);
			
	}
	
	function qgListFields($table){
		
		$this->Query("SHOW COLUMNS FROM {$table}");
		if(!($this->result)){
			return;
		}
		$rslist=array();
		while($row=@mysql_fetch_array($this->result))
		{
		    $rslis[]=$row["Field"];
		}
		return $rslist;
	}
	
	function qgListTables()
	{
			
		
		
	}
	function qgTableName($table_list,$i){
		
			
			
	}
	function qgEscapeString($char){
		
			
	}
	function get_mysql_version(){
			
	}
	
	function data(){
		
			return $this->DB->data;
	}
}
?>