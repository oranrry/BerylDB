<?php
session_start();
require_once("../Model/User.php");
require_once("../DB/DbBase.php");
require_once("../DB/Behavior/UserDBBehavior.php");

$goUrl = "../Test/Test1.php";
$userName=$_POST['login_name'];
$userPwd=$_POST['login_password'];
if(empty($userName))
{
	echo "<script>alert('�������û���!');history.back();</script>";
	return;
}
else if(empty($userPwd))
{
	echo "<script>alert('����������!');history.back();</script>";
	return;
}

$condition = "UserName = '" . $userName . "' and UserPassword = '" . substr(md5($userPwd),8,-8) . "'";
$UserDB = UserDBBehavior::getInstance();
$users = $UserDB->queryByCondition($condition);
if (!is_array($users) || count($users) < 1)
{
	echo "<script>alert('�û��������������!');history.back();</script>";
	return;
}

$user = $users[0];
echo("<script>alert('��½�ɹ�!');location.href='../Test/Test1.php';</script>");
$_SESSION['userId']=$user->UserId;
?>