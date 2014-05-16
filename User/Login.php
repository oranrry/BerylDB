<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/DB/Behavior/UserDBBehavior.php");
date_default_timezone_set('PRC');
function getIP() {
	if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	else if (@$_SERVER["HTTP_CLIENT_IP"])
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	else if (@$_SERVER["REMOTE_ADDR"])
		$ip = $_SERVER["REMOTE_ADDR"];
	else if (@getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (@getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (@getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = "Unknown";
	return $ip;
}

if(!isset($_POST['login_name']) || !$_POST['login_password'])
{
	echo "<script>location.href='/404.html';</script>";
}

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
$user = new UserInfo();
$user = $users[0];
//echo("<script>alert('登陆成功!');location.href='../Test/Test1.php';</script>");
$_SESSION['userId']=$user->UserId;
$user->LastLoginIp = getIP();
$user->LastLoginTime = date('Y-m-d H:i:s');
$UserDB->update($user);
echo(1);
?>