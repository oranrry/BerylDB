<?php

	session_start();
	require_once("../Model/User.php");
	require_once("../DB/DbBase.php");
	require_once("../DB/Behavior/UserDBBehavior.php");


	echo $_SESSION['userId'];
	$UserDB = UserDBBehavior::getInstance();
	$Data = $UserDB->queryById(1);

	echo(json_encode($Data));
?>