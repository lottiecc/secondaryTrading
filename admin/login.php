<?php
session_start();
//定义一个常量，用来授权访问includes里的文件
define('IN_ST',true);
//引入公共文件
require '../includes/common.inc.php';
//登录状态
//_login_state();

//开始处理登录状态
$oper = '';
if(isset($_GET['action'])) {
	$oper = $_GET['action'];
}
if ($oper == 'login'){
	//接收数据
	$_clean=array();
	$_clean['username']=$_POST['username'];
	$_clean['password']=$_POST['pwd'];
	//echo $_clean['username'];
	//到数据库验证
	if(!!$_rows = _fetch_array("SELECT st_username,st_password,UserType FROM st_user WHERE st_username='{$_clean['username']}' AND st_password='{$_clean['password']}' AND UserType=1 LIMIT 1")){
		mysql_close();
		session_destroy();
		setcookie('username',$_rows['st_username']);
		setcookie('UserType',1);
		header('Location:index.php');
	}else{
		header('Location:login.php');
	}
}
if ($oper == 'logout'){
	setcookie('username','');
	setcookie('UserType',-1);
	header('Location:login.php');
}
?>
	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
</head>

<body>
<form method="post" action="login.php?action=login">
<dl>
<dt>管理员登录</dt>
<dd>用户名：<input type="text" name="username" /></dd>
<dd>密码：<input type="password" name="pwd" /></dd>
<dd><input type="submit" name="submit" value="登录" /></dd>
</dl>
</form>
</body>
</html>