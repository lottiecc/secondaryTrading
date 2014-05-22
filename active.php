<?php
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//开始激活处理
if(!isset($_GET['active'])){
	_alert_back('非法操作！');
}
if(isset($_GET['action'])&&isset($_GET['active'])&&$_GET['action']=='ok'){
	$_active=_mysql_string($_GET['active']);
	if(_fetch_array("SELECT st_active FROM st_user WHERE st_active='$_active' LIMIT 1")){
		//将st_active设置为空
		_query("UPDATE st_user SET st_active='' WHERE st_active='$_active' LIMIT 1");
		if(_affected_rows()==1){
			_close();
			_location('账户激活成功','login.php');
		}else{
			_close();
			_location('账户激活失败','reg.php');
		}
	}else{
		_alert_back('非法操作');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>激活用户</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/active.css" />
<script type="text/javascript" src="js/code.js"></script>
</head>

<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div id="active">
	<h2>激活账户</h2>
    <p>本页面是为了模拟邮件的功能，点击以下超链接激活账户</p>
    <p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active']?>"><?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']?>?action=ok&amp;active=<?php echo $_GET['active']?> </a></p>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>