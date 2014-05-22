<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_ST',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','member');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//是否正常登录
if(!isset($_COOKIE['username'])){
	_Location('请先登录','login.php');
}else{
	$_rows=_fetch_array("SELECT st_username FROM st_user WHERE st_username='{$_COOKIE['username']}'");
	$_username=$_rows['st_username'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>

<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div id="member">
<?php
require ROOT_PATH.'includes/member.inc.php';
?>
    <div id="member_main">
    <h2>个人资料</h2>
    <ul>
    <li><a href="#">基本资料</a></li>
    <li><a href="#">头像照片</a></li>
    <li><a href="#">密码修改</a></li>
    </ul>
    <form name="modify" id="modify" method="post" action="?modify">
    <dl>
    <dd>昵称：<?php echo $_username;?></dd>
    <dd>真实姓名：</dd>
    <dd>学号：</dd>
    <dd>性别：<input type="radio" name="gender" value="1" />男
			 <input type="radio" name="gender" value="2"/>女
    </dd>
    <dd>居住地：<select id="area">
    		   <option value="0"  >&nbsp;&nbsp;</option>
    		   <option value="1"  >中苑</option>
			   <option value="2"  >西苑</option>
			   <option value="3"  >东苑</option>
			   <option value="4"  >北苑</option>
			   <option value="5"  >校外</option>
               </select>
    </dd>  
    <dd><input id="sub" name="sub" type="submit" value="保存" /></dd>
    </dl> 
    </form>
    </div>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>