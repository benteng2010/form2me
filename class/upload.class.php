<?php
#------------------------------------------------------------------------------
#[л��ʹ�ùȲ������ҵվ����qgweb]
#[�������ɹȲ����������ɣ���ǰ�汾��5.0]
#[���������LGPL��Ȩ����]
#[�����ʹ����ʽ�棬�뽫��Ȩ�ļ���FTP�ϴ���copyrightĿ¼��]
#[�ٷ���վ��www.gootopsoft.cn   www.gootop.net]
#[�ͷ����䣺max.zhang@gootop.net]
#[�ļ���request.php]
#------------------------------------------------------------------------------

#[��upload]
class UPLOAD
{
	var $path;
	var $type = ".jpg,.png,.gif,.rar,.zip";

	function UPLOAD($path,$type="png,jpg,gif,rar,zip")
	{
		$this->path = $path;
		//�����ļ�����
		$this->type = $this->set_type($type);
	}

	function set_type($type="png,jpg,gif,rar,zip,gz")
	{
		if(!$type)
		{
			$type = "png,jpg,gif,rar,zip,gz";
		}
		$type_array = explode(",",$type);
		$array = array();
		foreach($type_array as $key=>$value)
		{
			$value = trim($value);
			if(strlen($value)>1)
			{
				if((substr($value,0,1) != "."))
				{
					$value = ".".$value;
				}
				$array[$key] = $value;
			}
		}
		$this->type = implode(",",$array);
		$mytype = $this->type;
		return $mytype;
	}

	function up($var,$file="")
	{
		if(empty($var))
		{
			return false;
		}
		$file_name = $this->_check($file);
		if(empty($file_name)) $file_name = time();//����ļ���Ϊ�գ���ʹ��ʱ����Ϊ�ļ�����
		//����ļ������Ƿ��к�׺������ȥ��
		$file_name = strtolower($file_name);//�����д�д��ΪСд
		//-----
		$file_type = $this->_file_type($var);
		if($file_type)
		{
			if(strpos($file_name,".") === false)
			{
				$filename = $file_name.$file_type;//�µ��ļ���
			}
			else
			{
				$filename = $file_name;
			}
			#[����PHP��֧�ֿͻ��˼���ļ���С��������û�ж��ļ���С��������]
			#[�Ȳ������ҵվ�����ں�̨��Ҫ���ڿͻ��˶��ϴ����д�С���ƣ�]
			$up = @copy($_FILES[$var]["tmp_name"],$this->path.$filename);
			if($up)
			{
				return $filename;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function name($var)
	{
		return $_FILES[$var]["name"];
	}

	function _file_type($var)
	{
		if($_FILES[$var]["name"])
		{
			$name = explode(".",$_FILES[$var]["name"]);
			$count = count($name);
			$type = ".".strtolower($name[$count-1]);
			if(strpos($this->type,$type) === false)
			{
				return false;
			}
			return $type;
		}
		else
		{
			return false;
		}
	}

	function _check($file="")
	{
		if($file)
		{
			$array = explode("/",$file);
			$path = "";
			$count = count($array);
			if($count > 1)
			{
				for($i = 0;$i < ($count-1); $i++)
				{
					$path .= $array[$i]."/";
				}
			}
			$file_key = $count - 1;
			$return_file = basename($array[$file_key]);
			if((substr($file,0,1) == "/") || (substr($file,1,2) == ":"))
			{
				$this->_make_dir($path);
				$this->path = $path;//������·��
			}
			else
			{
				$this->_make_dir($this->path.$path);
				$this->path = $this->path.$path;
			}
			return $return_file;
		}
		else
		{
			return false;
		}
	}

	#[����Ŀ¼]
	function _make_dir($folder)
	{
		$array = explode("/",$folder);
		$count = count($array);
		$msg = "";
		for($i=0;$i<$count;$i++)
		{
			$msg .= $array[$i];
			if(!file_exists($msg) && ($array[$i]))
			{
				mkdir($msg,0777);
			}
			$msg .= "/";
		}
		return true;
	}

	function getpath()
	{
		return $this->path;
	}

	function qgfiletype($filename)
	{
		$filename = basename($filename);
		$name = explode(".",$filename);
		$count = count($name);
		$type = strtolower($name[$count-1]);
		return $type;
	}
}
?>