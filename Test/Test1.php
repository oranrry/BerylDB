<?php

	session_start();
	require_once($_SERVER["DOCUMENT_ROOT"]."/DB/Behavior/UserDBBehavior.php");

	$UserDB = UserDBBehavior::getInstance();
	$Data = $UserDB->queryById(1);

	echo(json_encode($Data));
?>