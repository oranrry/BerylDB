<?php

	require_once("../Model/User.php");
	require_once("../DB/DbBase.php");
	require_once("../DB/Behavior/UserDBBehavior.php");


	$UserDB = UserDBBehavior::getInstance();
	$Data = $UserDB->query();

	echo(json_encode($Data));
?>