<?php
#[ģ����]
#[�ر�˵�������ģ��������ѧϰ��SYSTN.COM��ģ����Ļ����ϸ�װ������]
#[Ӧ�ø���]
if(!defined("PHPOK_SET"))
{
	die("<h3>Error...</h3>");
}
class QG_C_TEMPLATE
{
	var $thisvalue = array();
	var $imgdir = array("images");
	var $hacker = "<?php if(!defined('PHPOK_SET')){die('<h3>Error...</h3>');}?>";
	var $compile = array(
		'/(\{|<!--\s*)inc_php:([^\{\}]{1,100})(\}|\s*-->)/eisU',
		'/(\{|<!--\s*)php:([^\{\}]{1,100})(\}|\s*-->)/eisU',
		'/(\{|<!--\s*)inc:([^\{\}]{1,100})(\}|\s*-->)/eisU',
		'/(\{|<!--\s*)IF\((.+)\)(\}|\s*-->)/isU',
		'/(\{|<!--\s*)ELSEIF\((.+)\)(\}|\s*-->)/isU',
		'/(\{|<!--\s*)ELSE(\}|\s*-->)/isU',
		'/(\{|<!--\s*)END(\}|\s*-->)/isU',
		'/(\{|<!--\s*)([a-zA-Z0-9_\$\[\]\'\\\"]{2,60})\s*(AS|as)\s*(.+)(\}|\s*-->)/isU',
		'/(\{|<!--\s*)while\:(.+)(\{|<!--\s*)/isU',
		'/(\{|<!--\s*)row\:(.+)(\}|\s*-->)/eisU',
		'/(\{|<!--\s*)color\:\s*(.+)(\}|\s*-->)/eisU',
		'/(\{|<!--\s*)img\:([^\{\}]{1,100})(\}|\s*-->)/eisU',
		'/(\{|<!--\s*)run\:(\}|\s*-->)\s*(.+)\s*(\{|<!--\s*)\/run(\}|\s*-->)/isU',
		'/(\{|<!--\s*)run\:(.+)(\}|\s*-->)/isU',
		'/\{:([a-zA-Z0-9_\'\"\[\]\(\)\$]+)\}/isU',
	);

	var $analysis = array(
		'$this->qg_php("\\2")',
		'$this->qg_php("\\2")',
		'$this->qg_inc("\\2")',
		'<?php if(\\2){?>',
		'<?php }elseif(\\2){ ?>',
		'<?php }else{ ?>',
		'<?php } ?>',
		'<?php \$_i=0;\\2=(is_array(\\2))?\\2:array();foreach(\\2 AS \\4){\$_i++; ?>',
		'<?php \$_i=0;while(\\2){\$_i++; ?>',
		'$this->row("\\2")',
		'$this->color("\\2")',
		'$this->image("\\2")',
		'<?php \\3;?>',
		'<?php \\2;?>',
		'<?php echo \\1;?>'
	);

	var $tplid = 1;
	var $tpldir = "template";
	var $cache = "data";
	var $phpdir = "";
	var $ext = "htm";
	var $autorefresh = true;#[�Զ�ˢ�±���ģ��]
	var $autoimg = true;

	#[����ģ��]
	#[$tplid��ģ�������ID]
	#[$tpldir��ģ��Ŀ¼]
	#[$cache��������PHP�ļ�Ŀ¼]
	#[$phpdir��PHP�ļ�Ŀ¼]
	#[$autoimg������ͼƬ·��]
	function __construct
	(
		$set = array
		(
			"tplid"=>"1",
			"tpldir"=>"template",
			"cache"=>"data",
			"phpdir"=>"",
			"ext"=>"htm",
			"autorefresh"=>true,
			"autoimg"=>true
		)
	)
	{
		$this->tplid = $set["tplid"] ? $set["tplid"]."_" : "1_";
		$this->tpldir = $set["tpldir"] ? $set["tpldir"] : "template";
		$this->cache = $set["cache"] ? $set["cache"] : "data";
		$this->phpdir = $set["phpdir"] ? $set["phpdir"] : "";
		$this->ext = $set["ext"] ? $set["ext"] : "htm";
		$this->autoimg = $set["autoimg"];
		#[�ж��Ƿ�ʹ�ó���]
		if(defined("TemplateID"))
		{
			$this->tplid = TemplateID."_";
		}
		if(defined("NewCache"))
		{
			$this->cache = NewCache;
		}
		if(defined("NewTemplate"))
		{
			$this->tpldir = NewTemplate;
		}
	}

	#[����PHP4]
	function template
	(
		$set = array
		(
			"tplid"=>1,
			"tpldir"=>"template",
			"cache"=>"data",
			"phpdir"=>"",
			"ext"=>"htm",
			"autorefresh"=>true,
			"autoimg"=>true
		)
	)
	{
		$this->__construct($set);
	}

	#[����]
	function set($value,$var)
	{
		$this->$var = $value;
	}

	function set_var($name,$var="")
	{
		$this->thisvalue[$name] = $var;
	}

	#[����ļ�]
	function p($filename,$newdir="",$tplid=0)
	{
		#[���δ���ã���ʹ��ģ���ļ�]
		if(!$filename)
		{
			return false;
		}
		$tpldir = $newdir ? $newdir : $this->tpldir;
		$tplid = $tplid ? $tplid."_" : $this->tplid;
		#[�ѱ������ļ�]
		$c_file = $this->cache."/".$tplid."".$filename.".php";
		if(!$this->autorefresh && file_exists($c_file))
		{
			@extract($this->_value());
			include_once($this->cache."/".$tplid."".$filename.".php");
			return true;
		}
		#[ģ���ļ�]
		$r_file = $tpldir."/".$filename.".".$this->ext;
		if(!file_exists($c_file))
		{
			if(file_exists($r_file))
			{
				$content = $this->_read($r_file);
			}
			else
			{
				$r_file = $tpldir."/../default/".$filename.".".$this->ext;
				if(!file_exists($r_file))
				{
					echo "tpl not exit!";
					exit;
				}
				$content = $this->_read($r_file);
			}
			$content = $this->_c($content);
			if(!$content)
			{
				return false;
			}
			$content = $this->_imgcheck($content);
			#[������д��]
			$this->_write($content,$c_file);
			unset($content);
			@extract($this->_value());
			include_once($c_file);
			return true;
		}
		#[����ļ��ı���ʱ��]
		$tpl_time = $this->_time($r_file);#[ģ���ļ�����ʱ��]
		$php_time = $this->_time($c_file);
		if($tpl_time > $php_time)
		{
			$content = $this->_read($r_file);
			$content = $this->_c($content);
			if(!$content)
			{
				return false;
			}
			$content = $this->_imgcheck($content);
			#[������д��]
			$this->_write($content,$c_file);
			unset($content);
			@extract($this->_value());
			include_once($c_file);
			return true;
		}
		@extract($this->_value());
		include($c_file);
		return true;
	}

	#[����������PHP�ļ���֧����ַ]
	function qg_php($string)
	{
		if(strpos($string,"?") === false)
		{
			$msg = '<?php include_once("'.$this->phpdir.'/'.$string.'.php");?>';
		}
		else
		{
			if(strpos(strtolower($string),"http://") === false)
			{
				$msg = '<?php include_once("'.$this->_sysurl().'/'.$this->phpdir.'/'.$string.'");?>';
			}
			else
			{
				$msg = '<?php include_once("'.$string.'");?>';
			}
		}
		return $msg;
	}

	function qg_inc($string)
	{
		$array = explode("|",$string);
		if(!$array[0])
		{
			return false;
		}
		$tpl = trim($array[0]);
		$tpldir = $array[1] ? trim($array[1]) : "";
		$tplid = $array[2] ? trim($array[2]) : 0;
		$msg = '<?php QG_C_TEMPLATE::p("'.$tpl.'","'.$tpldir.'","'.$tplid.'");?>';
		return $msg;
	}

	function row($num="")
	{
		$num = trim($num);
		if(!$num)
		{
			return false;
		}
		$nums = explode(",",$num);
		$numr = intval($nums[0]) > 0 ? intval($nums[0]) : 2;
		$input = trim($nums[1]) ? $nums[1] : "</tr><tr>";
		if(trim($nums[1]))
		{
			$Co	 = explode(":",$nums[1]);
			$outstr = "if(\$_i%$numr===0){\$row_count++;echo(\$row_count%2===0)?'</tr><tr bgcolor=\"$Co[0]\">':'</tr><tr bgcolor=\"$Co[1]\">';}";
		}
		else
		{
			$outstr = "if(\$_i%$numr===0){echo '$input';}";
		}
		$msg = "<?php ".$outstr."?>";
		return $msg;
	}

	function color($color="")
	{
		if(!$color)
		{
			return false;
		}
		$Co = explode(",",$color);
		if(count($Co)==2)
		{
			$OutStr = "echo(\$_i%2===0)?'$Co[0]':'$Co[1]';";
			return "<?php ".$OutStr."?>";
		}
	}

	function image($adds="")
	{
		$adds_ary = explode(",",$adds);
		if(is_array($adds_ary))
		{
			$this->imgdir = (is_array($this->imgdir))?@array_merge($adds_ary, $this->imgdir):$adds_ary;
		}
	}

	#[��������]
	function _c($content="")
	{
		if(!$content)
		{
			return false;
		}
		$content = str_replace('\\','\\\\',$content);
		$content = str_replace('"','\"',$content);
		$content = preg_replace($this->compile,$this->analysis,$content);
		return $content;
	}

	function _read($filename)
	{
		return file_get_contents($filename);
	}

	function _write($content,$filename,$mode="wb")
	{
		$content = trim($content);
		$filename = trim($filename);
		if($content && $filename)
		{
			$content = stripslashes($content);
			$handle = @fopen($filename,$mode);
			@fwrite($handle,$this->hacker.$content);
			fclose($handle);
			return true;
		}
		else
		{
			return false;
		}
	}

	function _sysurl()
	{
		if($_SERVER["SERVER_NAME"])
		{
			return str_replace("http://","",$_SERVER["SERVER_NAME"]);
		}
		else
		{
			return false;
		}
	}

	//������������빫������
	function _value()
	{
		return (is_array($GLOBALS))?array_merge($this->thisvalue,$GLOBALS):$this->thisvalue;
	}

	#[����ͼƬ]
	function _imgcheck($content)
	{
		if(!$this->autoimg)
		{
			return $content;
		}
		if(is_array($this->imgdir))
		{
			foreach($this->imgdir AS $rep)
			{
				$rep = trim($rep);
				if(substr($rep,-1)=='/')
				{
					$rep = substr($rep,0,strlen($rep)-1);
				}
				$content = str_replace($rep.'/',$this->tpldir."/".$rep.'/',$content);
			}
			#[��������]
			if(ereg($this->tpldir."/".$this->tpldir,$content))
			{
				$content = str_replace($this->tpldir."/".$this->tpldir,$this->tpldir."/",$content);
			}
		}
		return $content;
	}

	#[����ʱ��]
	function _time($filename)
	{
		if(!file_exists($filename))
		{
			return false;
		}
		return filemtime($filename);
	}
}
?>