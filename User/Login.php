<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/DB/Behavior/UserDBBehavior.php");

$userName=$_POST['login_name'];
$userPwd=$_POST['login_password'];
if(empty($userName))
{
	//echo "<script>alert('请输入用户名!');history.back();</script>";
	echo "请输入用户名！";
	return;
}
else if(empty($userPwd))
{
	//echo "<script>alert('请输入密码!');history.back();</script>";
	echo "请输入密码！";
	return;
}

$condition = "UserName = '" . $userName . "' and UserPassword = '" . substr(md5($userPwd),8,-8) . "'";
$UserDB = UserDBBehavior::getInstance();
$users = $UserDB->queryByCondition($condition);
if (!is_array($users) || count($users) < 1)
{
	//echo "<script>alert('用户名或者密码错误!');history.back();</script>";
	echo "用户名或者密码错误！";
	return;
}

$user = $users[0];
//echo("<script>alert('登陆成功!');location.href='../Test/Test1.php';</script>");
$_SESSION['userId']=$user->UserId;
echo(1);
?>