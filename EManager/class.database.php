<?php

/*define("DB","movemewi_movemewithcare");
define("DB_HOST","localhost");
define("DB_USER","movemewi_movemew");
define("DB_PASSWORD","withcare");*/


define("DB","movemewi_proacemmwc");
define("DB_HOST","localhost");
define("DB_USER","movemewi_movemew");
define("DB_PASSWORD","withcare");


define("SYSTEM_EMAIL_NAME","MMWC-SYSTEM");
define("COOKIES_PATH", "/EManager");

require_once "mailer.php";

mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Server Not Responding, Please Try Again Later.....");
mysql_select_db(DB) or die("DataBase unavailable.....");

class Database
{
        var $rs=0;

	function Database()
	{
	}
	
	
	function query($sql)
        {
		$this->rs=mysql_query($sql);
		if($this->rs)
			return true;
	        else
		{		
			echo "ERROR: " . $sql;
			return false;
		}
        }

	function fetch_row()
	{
		return mysql_fetch_row($this->rs);
	}

	function get_num_rows()
	{
		return mysql_num_rows($this->rs);
	}
	
	function move_to_row($num)
	{
		if($num>=0 && $this->rs)
		{
			return mysql_data_seek($this->rs,$num);
		}
		return 1;
	}

	function get_num_columns()
	{
		return mysql_num_fields($this->rs);
	}

	function fetch_all()
	{
		$ret= array();
		$num = $this->get_num_rows();
		for($i=0;$i<$num;$i++)
		{
			array_push($ret,$this->fetch_row());
		}
		return $ret;
	}

	function get_column_names()
	{
		$nofields= mysql_num_fields($this->rs);
		$fieldnames=array();
		for($k=0;$k<$nofields;$k++)
		{
			array_push($fieldnames,mysql_field_name($this->rs,$k));
		}
		return $fieldnames;
	}

	function get_last_error()
	{
		return mysql_error();
	}
}

function CheckString($strString)
{
	$strString = str_replace("'", "''", $strString);
	$strString = str_replace("\'", "'", $strString);
	$strString = str_replace("\\", "", $strString);

	return $strString;
}

function WebString($strString)
{
	//Insert line breaks
	$strString = ereg_replace("(\r\n|\n|\r)","<br/>", $strString);
	return ($strString);
}

//format string to display in a text field
function TextString($strString)
{
	$strString = ereg_replace("<br/>","\r\n", $strString);
	return ($strString);
}

function Chk($strString)
{
	$strString = str_replace("\"", "&quot;", $strString);
	return $strString;
}
?>