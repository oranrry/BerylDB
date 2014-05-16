<?php
class PagingData{
  	public $Data;
	public $DataCount;
	public $PageCount;
}

abstract class DbBase {
	private $ServerName = "localhost:3306";
	private $UserName = "root";
	private $SqlPWD = "";
	private $DbName = "beryldb";
	protected $tableName;
	protected $ColNames;
	protected $IdName;


	//构造函数
	protected function __construct()
	{
		$this->setInstance();
	}

	//构造函数
	protected abstract function setInstance();


	//阻止用户复制对象实例
	private function __clone()
	{
		trigger_error('Clone is not allow',E_USER_ERROR);
	}

	//检查数据是否合法
	private function check()
	{
		return isset($this->ColNames) && isset($this->tableName) && isset($this->IdName);
	}

	function inject_sql_replace($str)
	{
		$str = str_replace("execute","",$str);
		$str = str_replace("update","",$str);
		$str = str_replace("count","",$str);
		$str = str_replace("chr","",$str);
		$str = str_replace("mid","",$str);
		$str = str_replace("master","",$str);
		$str = str_replace("truncate","",$str);
		$str = str_replace("char","",$str);
		$str = str_replace("declare","",$str);
		$str = str_replace("select","",$str);
		$str = str_replace("create","",$str);
		$str = str_replace("delete","",$str);
		$str = str_replace("insert","",$str);
		$str = str_replace("\"","",$str);
	    $str = str_replace("%20","",$str);
	   return $str;
	}

	//查询数据
	public function query()
	{
		$dataArray = NULL;
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "select * from " . $this->tableName;
			$result=mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			$dataArray = array();
			while($row=mysqli_fetch_object($result,$this->tableName))
			{
				$dataArray[]=$row;
			}
			mysqli_close($con);
		}
		return $dataArray;
	}

	public function queryByPaging($pageIndex,$pageSize)
	{
		$data = new PagingData();
		$pageIndex = intval($pageIndex);
		$pageSize = intval($pageSize);
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "select count(1) from " . $this->tableName;
			$result=mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			$data->DataCount = (int)mysqli_fetch_row($result)[0];
			$data->PageCount = ceil($data->DataCount / $pageSize);
			$sql = "select * from  " . $this->tableName . " limit " . (($pageIndex - 1)*$pageSize) . "," . $pageSize;
			$result=mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			$data->Data = array();
			while($row=mysqli_fetch_object($result,$this->tableName))
			{
				$data->Data[]=$row;
			}
			mysqli_close($con);
		}

		return $data;
	}

	//查询数据
	public function queryByCondition($condition)
	{
		$dataArray = NULL;
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "select * from " . $this->tableName . " where 1 = 1 and " . $this->inject_sql_replace($condition);
			$result=mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			$dataArray = array();
			while($row=mysqli_fetch_object($result,$this->tableName))
			{
				$dataArray[]=$row;
			}
			mysqli_close($con);
		}
		return $dataArray;
	}

	//插入数据
	public function insert($dataObj)
	{
		if($this->Check())
		{
			$valuesStr ="";
			$dataArray = (array)$dataObj;
			$arrayLength = count($this->ColNames);
			for($i=0;$i<$arrayLength;$i++)
			{
				$valuesStr = $valuesStr . $dataArray[$this->ColNames[$i]];
				if($i<$arrayLength - 1)
				{
					$valuesStr = "'" .$valuesStr . "',";
				}
			}


			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "insert into " .$this->tableName ."(" . join(",", $this->ColNames) .") VALUES(". $valuesStr .")" ;
			mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			mysqli_close($con);
		}
	}

	//更新数据
	public function update($dataObj)
	{
		if($this->Check())
		{
			$setValueStr = "";
			$dataArray = (array)$dataObj;
			$arrayLength = count($this->ColNames);
			for($i=0;$i<$arrayLength;$i++)
			{
				$colName = $this->ColNames[$i];
				$setValueStr = $setValueStr . $colName . " = '" . $dataArray[$colName]. "'";
				if($i<$arrayLength - 1)
				{
					$setValueStr = $setValueStr . ",";
				}
			}

			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "update " .$this->tableName ." set " . $setValueStr . " where " . $this->IdName . " = " . $dataArray[$this->IdName] ;
			mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			mysqli_close($con);
		}
	}

	//删除数据
	public function delete($id)
	{
		$data = NULL;
		$id = intval($id);
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "delete from " . $this->tableName . " where " . $this->IdName ." = " . $id;
			mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			mysqli_close($con);
		}
		return $data;
	}

	//根据Id查询数据
	public function queryById($id)
	{
		$data = NULL;
		$id = intval($id);
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("数据库连接异常！" . mysqli_error($con));
			//mysqli_select_db($this->DbName, $con) or die("数据库选择异常" . mysql_error());;
			$sql = "select * from " . $this->tableName . " where " . $this->IdName ." = " . $id;
			$result=mysqli_query($con,$sql) or die("数据库查询异常" . $sql . mysqli_error($con));
			$data =mysqli_fetch_object($result,$this->tableName);
			mysqli_close($con);
		}
		return $data;
	}
}

?>