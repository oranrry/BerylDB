<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/Model/User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/DB/DbBase.php");

class UserDBBehavior extends DbBase {
	private static $_instance = NULL;
	//单例模式
	public static function getInstance()
	{
		if(!self::$_instance instanceof self)
		{
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	protected function setInstance()
	{
		$this->tableName = "UserInfo";
		$this->IdName="UserId";
		$this->ColNames = array("UserName","UserPassword",
		"CreatedTime","UserStatus","LastLoginIp","LastLoginTime");
	}
}
?>