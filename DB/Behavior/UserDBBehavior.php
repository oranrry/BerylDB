<?php

class UserDBBehavior extends DbBase {
	private static $_instance = NULL;
	//µ¥ÀýÄ£Ê½
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
		$this->ColNames = array("UserId","UserName","UserPassword",
		"CreatedTime","UserStatus","LastLoginIp","LastLoginTime","VersionNo");
	}
}
?>