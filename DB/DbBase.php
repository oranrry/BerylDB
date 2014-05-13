<?php

abstract class DbBase {
	private $ServerName = "localhost:3306";
	private $UserName = "root";
	private $SqlPWD = "";
	private $DbName = "beryldb";
	protected $tableName;
	protected $ColNames;
	protected $IdName;


	//���캯��
	protected function __construct()
	{
		$this->setInstance();
	}

	//���캯��
	protected abstract function setInstance();


	//��ֹ�û����ƶ���ʵ��
	private function __clone()
	{
		trigger_error('Clone is not allow',E_USER_ERROR);
	}

	//��������Ƿ�Ϸ�
	private function check()
	{
		return isset($this->ColNames) && isset($this->tableName) && isset($this->IdName);
	}

	//��ѯ����
	public function query()
	{
		$dataArray = array();
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("���ݿ������쳣��" . mysqli_error());
			//mysqli_select_db($this->DbName, $con) or die("���ݿ�ѡ���쳣" . mysql_error());;
			$sql = "select * from " . $this->tableName;
			$result=mysqli_query($con,$sql) or die("���ݿ��ѯ�쳣" . mysqli_error());;
			$dataArray = array();
			while($row=mysqli_fetch_object($result,$this->tableName))
			{
				$dataArray[]=$row;
			}
			mysqli_close($con);
		}
		return $dataArray;
	}

	//��������
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
					$valuesStr = $valuesStr . ",";
				}
			}


			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("���ݿ������쳣��" . mysqli_error());
			//mysqli_select_db($this->DbName, $con) or die("���ݿ�ѡ���쳣" . mysql_error());;
			$sql = "insert into " .$this->tableName ."(" . join(",", $this->ColNames) .") VALUES(". $valuesStr .")" ;
			mysqli_query($con,$sql) or die("���ݿ��ѯ�쳣" . mysqli_error());;
			mysqli_close($con);
		}
	}

	//��������
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
				$setValueStr = $setValueStr . $colName . " = " . $dataArray[$colName];
				if($i<$arrayLength - 1)
				{
					$setValueStr = $setValueStr . ",";
				}
			}

			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("���ݿ������쳣��" . mysqli_error());
			//mysqli_select_db($this->DbName, $con) or die("���ݿ�ѡ���쳣" . mysql_error());;
			$sql = "update " .$this->tableName ." set " . $setValueStr . " where " . $this->IdName . " = " .$dataObj.$this->IdName ;
			mysqli_query($con,$sql) or die("���ݿ��ѯ�쳣" . mysqli_error());;
			mysqli_close($con);
		}
	}

	//ɾ������
	public function delete($id)
	{
		$data = NULL;
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("���ݿ������쳣��" . mysqli_error());
			//mysqli_select_db($this->DbName, $con) or die("���ݿ�ѡ���쳣" . mysql_error());;
			$sql = "delete from " . $this->tableName . " where " . $this->IdName ." = " . $id;
			mysqli_query($con,$sql) or die("���ݿ��ѯ�쳣" . mysqli_error());;
			mysqli_close($con);
		}
		return $data;
	}

	//����Id��ѯ����
	public function queryById($id)
	{
		$data = NULL;
		if($this->Check())
		{
			$con = mysqli_connect($this->ServerName,$this->UserName,$this->SqlPWD,$this->DbName) or die("���ݿ������쳣��" . mysqli_error());
			//mysqli_select_db($this->DbName, $con) or die("���ݿ�ѡ���쳣" . mysql_error());;
			$sql = "select * from " . $this->tableName . " where " . $this->IdName ." = " . $id;
			$result=mysqli_query($con,$sql) or die("���ݿ��ѯ�쳣" . mysqli_error());;
			$data =mysql_fetch_object($result,$this->tableName);
			mysqli_close($con);
		}
		return $data;
	}
}

?>