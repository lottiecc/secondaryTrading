<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//登录状态
_login_state();
//开始处理登录状态
if(isset($_GET['action'])&&$_GET['action']=='login'){
	//引入验证文件
	include ROOT_PATH.'includes/login.func.php';
	//接收数据
	$_clean=array();
	$_clean['username']=$_POST['user-info'];
	$_clean['password']=$_POST['user-pwd'];
	print_r($_clean);
	//到数据库验证
	if(!!$_rows=_fetch_array("SELECT st_username,st_uniqid FROM st_user WHERE st_username='{$_clean['username']}' AND st_password='{$_clean['password']}' AND st_active='' LIMIT 1")){
		_close();
		_session_destroy();
		_setcookie($_rows['st_username'],$_rows['st_uniqid']);
		header('Location:index.php');
	}else{
		_close();
		_session_destroy();
		_location('用户名或密码不正确或者该账户未被激活！','login.php');
	}
}
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录</title>
<link rel="stylesheet" href="styles/login.css">
<script type="text/javascript" src="js/code.js"></script>
<style>
@font-face{
font-family:Logo;
src:url('font/ZapfinoExtraLT-Four.otf');
}
header h1{
	font-family:Logo;
}
</style>
</head>

<body>
<div id="wrap">
    <header>
        <h1><a href="index.php" class="logo">N J U E </a></h1>
    </header>
    
    <div id="login">
    <form method="post" name="login" action="login.php?action=login">
        <div class="login-title">
        <h1>登录</h1>
        </div>
        <div class="login-form">
        <label for="user-info">用户名</label>
        <input id="user-info" class="text" type="text" tabindex="1" name="user-info" auto-focus="auto-focus" />
        <label for="user-pwd">密码</label>
        <input id="user-pwd" class="text" type="password" tabindex="2" name="user-pwd" />
        <input class="button" type="submit" value="登录" tabindex="3" name="user-sub" />
        <div id="another-info">
        <a href="javascript:;">忘记密码？</a>
        <span>|</span>
        <a href="reg.php">注册</a>
        </div>
        </div>
    </form>
    </div>
</div>

</body>
</html>