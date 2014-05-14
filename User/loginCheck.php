<?php

session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/DB/Behavior/UserDBBehavior.php");

if(isset($_SESSION["userId"])&&time()>$_SESSION['userId'] + 1200){
	$UserDB = UserDBBehavior::getInstance();
	$user = $UserDB->queryById($_SESSION['userId']);
	if($user == NULL)
	{
		echo "<script>location.href='User/login.html';</script>";
	}
}
else
{
	echo "<script>location.href='User/login.html';</script>";
}

?>