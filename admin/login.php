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
	


<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
<style>
@font-face{
font-family:Logo;
src:url('../font/ZapfinoExtraLT-Four.otf');
}
header h1{
	font-family:Logo;
	color: #e31335;
}
</style>
</head>

<body>
<header>
<h1>NJUE SecTrading</h1>
</header>
<form method="post" action="login.php?action=login">
<dl>
<dt>管理员登录</dt>
<dd>用户名：<input type="text" name="username" /></dd>
<dd>密    码：<input type="password" name="pwd" /></dd>
<dd><input type="submit" name="submit" value="登录" /></dd>
</dl>
</form>
</body>
</html>