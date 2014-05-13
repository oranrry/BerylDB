<?php

	session_start();
	require_once("Model/User.php");
	require_once("DB/DbBase.php");
	require_once("DB/Behavior/UserDBBehavior.php");

	if(isset($_SESSION["userId"])&&time()>$_SESSION['userId'] + 1200){
		$UserDB = UserDBBehavior::getInstance();
		$user = $UserDB->queryById($_SESSION['userId']);
		if($user != NULL)
		{
			echo "<hr>";
			echo $user->UserName;
			echo "<hr>";
			echo "welcome back";
		}
		else
		{
			echo "<script>location.href='User/login.html';</script>";
		}

	}
	else
	{
			echo "<script>location.href='User/login.html';</script>";
	}
?>