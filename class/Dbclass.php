<?php 
	$DB= new DbClass($dbType);
	switch ($dbType){
		case 'mysql':
			$DB->setHost($dbHost);
			$DB->setData($dbData);
			$DB->setUser($dbUser);
			$DB->setPass($dbPass);
			break;
		case 'sqlite':
			$DB->setDbname($dbName);
			break;
	    default:
	}
	$DB->connect();
	/**
	 * @author huangyong
	 * @time:2009.9.30
	 */
	class DbClass{
		#[mysql用的变量
			var  $queryCount = 0;
			private  $host;
			private $user;
			private $pass;
			private $data;
			private $conn;
			private $rsType = MYSQL_ASSOC;
			private $queryTimes = 0;#[查询时间]
		#]/////////////
		#[sqlite用的变量
			private $link;
			private $querynum = 0;
			private $dbName="gootopcms.db3";
			private $debug=true;
		#]///////////
		 #[共用变量
		 	 private $result;
		 	 private $dbType='mysql';
		 	 private $DB;
		#[数据类路径
			const DBCLASSDIR='dbclass/';
		#]
		#-----------------------方法-----------------------------------
		function __construct($sqlType='mysql'){
			#php5构造器，优先级比同类名的构造器高
			$this->dbType=$sqlType;
			
		}
		function DbClass($sqlType='mysql'){
			$this->__construct($sqlType);
		}
	 /**
	 * @param 连接数据库
	 */
		function connect($dbtype=''){
			if($dbtype!=''){
				$this->dbType=$dbtype;
			}
			$dbtype=$this->dbType;
			switch ($dbtype){
				case 'mysql':
					$this->DbClassMysql();
					break;
				case 'sqlite':
					$this->DbClassSqlite();
					break;
			    default:
			}
		}
		
		/**
		 * @param 构造器生成对象，此方法获取该对象
		 */	
		public function getDB(){
			
			return $this->DB;
		}
		/**
		 * @param #mysql数据库构造函数
		 */
		function DbClassMysql(){
			#mysql数据库构造函数 
			include ('mysql.db.class.php');
			$this->DB=new MySql($this->host,$this->data,$this->user,$this->pass);
		}
		/**
		 * @param #sqlite数据库构造函数
		 */
		function DbClassSqlite(){
			#sqlite数据库构造函数
			include('sqlite.db.class.php');
			$this->DB=new Sqlite($this->dbName);
		}
		function qgGetOne($sql=''){
			return $this->DB->qgGetOne($sql);
		}
		function qgInsert($sql=''){
			return $this->DB->qgInsert($sql);
		}
		function qgInsertID($sql=''){
			return $this->DB->qgInsertID($sql='');
		}
		function qgGetAll($sql='',$nocache=false){
			return $this->DB->qgGetAll($sql,$nocache);
			
		}
		function queryCount(){
			return $this->DB->queryCount;
		}
		function qgCount($sql=''){
			return $this->DB->qgCount($sql);
		}
		function qgQuery($sql=''){
			return $this->DB->qgQuery($sql);
		}
		function qg_count($sql=''){
			return $this->DB->qg_count($sql);
		}
		function qgNumFields($sql = ""){
			return $this->DB->qgNumFields($sql = "");
		}
		function qgListFields($table){
			return $this->DB->qgListFields($table);
		}
		function qgListTables(){
			return $this->DB->qgListTables();
		}
		function qgTableName($table_list,$i){
			return $this->DB->qgTableName($table_list,$i);
		}
		function qgEscapeString($char){
			return $this->DB->qgEscapeString($char);
		}
		function get_mysql_version(){
			return $this->DB->get_mysql_version();
		}
		function data(){
			return $this->DB->data;
		}
		/**
	 * @param $DB the $DB to set
	 */
	public function setDB($DB) {
		$this->DB = $DB;
	}

		/**
	 * @param $dbType the $dbType to set
	 */
	public function setDbType($dbType) {
		$this->dbType = $dbType;
	}

		/**
	 * @param $result the $result to set
	 */
	public function setResult($result) {
		$this->result = $result;
	}

		/**
	 * @param $debug the $debug to set
	 */
	public function setDebug($debug) {
		$this->debug = $debug;
	}

		/**
	 * @param $querynum the $querynum to set
	 */
	public function setQuerynum($querynum) {
		$this->querynum = $querynum;
	}

		/**
	 * @param $link the $link to set
	 */
	public function setLink($link) {
		$this->link = $link;
	}

		/**
	 * @param $queryTimes the $queryTimes to set
	 */
	public function setQueryTimes($queryTimes) {
		$this->queryTimes = $queryTimes;
	}

		/**
	 * @param $rsType the $rsType to set
	 */
	public function setRsType($rsType) {
		$this->rsType = $rsType;
	}

		/**
	 * @param $conn the $conn to set
	 */
	public function setConn($conn) {
		$this->conn = $conn;
	}

		/**
	 * @param $data the $data to set
	 */
	public function setData($data) {
		$this->data = $data;
	}

		/**
	 * @param $pass the $pass to set
	 */
	public function setPass($pass) {
		$this->pass = $pass;
	}

		/**
	 * @param $user the $user to set
	 */
	public function setUser($user) {
		$this->user = $user;
	}

		/**
	 * @param $host the $host to set
	 */
	public function setHost($host) {
		$this->host = $host;
	}

		/**
	 * @param $queryCount the $queryCount to set
	 */
	public function setQueryCount($queryCount) {
		$this->queryCount = $queryCount;
	}

		/**
	 * @return the DBCLASSDIR
	 */
	public function getBCLASSDIR() {
		return $this->DBCLASSDIR;
	}

		/**
	 * @return the $dbType
	 */
	public function getDbType() {
		return $this->dbType;
	}

		/**
	 * @return the $result
	 */
	public function getResult() {
		return $this->result;
	}

		/**
	 * @return the $debug
	 */
	public function getDebug() {
		return $this->debug;
	}

		/**
	 * @return the $querynum
	 */
	public function getQuerynum() {
		return $this->querynum;
	}

		/**
	 * @return the $link
	 */
	public function getLink() {
		return $this->link;
	}

		/**
	 * @return the $queryTimes
	 */
	public function getQueryTimes() {
		return $this->queryTimes;
	}

		/**
	 * @return the $rsType
	 */
	public function getRsType() {
		return $this->rsType;
	}

		/**
	 * @return the $conn
	 */
	public function getConn() {
		return $this->conn;
	}

		/**
	 * @return the $data
	 */
	public function getData() {
		return $this->data;
	}

		/**
	 * @return the $pass
	 */
	public function getPass() {
		return $this->pass;
	}

		/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

		/**
	 * @return the $host
	 */
	public function getHost() {
		return $this->host;
	}

		/**
	 * @return the $queryCount
	 */
	public function getQueryCount() {
		return $this->queryCount;
	}
	/**
	 * @param $dbName the $dbName to set
	 */
	public function setDbName($dbName) {
		$this->dbName = $dbName;
	}

	/**
	 * @return the $dbName
	 */
	public function getDbName() {
		return $this->dbName;
	}	
}
?>