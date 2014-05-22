<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//登录状态
_login_state();
//判断是否提交了
if(isset($_GET['action'])&&$_GET['action']=='register'){
	//为了防止恶意注册，跨站攻击	
	_check_code($_POST['icode'],$_SESSION['code']);	
	//引入验证文件
	include ROOT_PATH.'includes/reg.func.php';
	//创建一个空数组，用来存放提交过来的合法数据
	$_clean=array();
	//可以通过唯一标示符来防止恶意注册，伪装表单跨站攻击等
	//这个存放入数据库的唯一标识符还有第二个用处，就是登录cookie验证
	$_clean['uniqid']=_check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
	//active也是一个唯一标识符，用来共注册的用户进行激活处理，方可登录
	$_clean['active']=_sha1_uniqid();
	$_clean['username']=$_POST['username'];
	$_clean['password']=$_POST['password'];
	$_clean['notpwd']=$_POST['notpwd'];
	$_clean['email']=$_POST['email'];
	$_clean['icode']=$_POST['icode'];
	
	//新增前，判断用户名是否重复
	//$query=_query("SELECT st_username FROM st_user WHERE st_username='{$_clean['username']}'");
//	if(mysql_fetch_array($query,MYSQL_ASSOC)){
//		_alert_back('对不起，此用户已被注册！');
//	}

//	if(_fetch_array("SELECT st_username FROM st_user WHERE st_username='{$_clean['username']}'")){
//		_alert_back('对不起，此用户已被注册！');
//	}

	_is_repeat(
			   "SELECT st_username FROM st_user WHERE st_username='{$_clean['username']}'",
			   '对不起，此用户已被注册！'
			   );
	
	
	//新增用户
	mysql_query(
				"INSERT INTO st_user(
									st_uniqid,
									st_active,
									st_username,
									st_password,
									st_email,
									st_photo
									) 
							VALUES(
								   	'{$_clean['uniqid']}',
									'{$_clean['active']}',
									'{$_clean['username']}',
									'{$_clean['password']}',
									'{$_clean['email']}',
									'noimg.jpg'
									)"
				)or die('sql wrong'.mysql_error());
	if(_affected_rows()==1){
		//关闭
		mysql_close();
		//跳转
		_location('恭喜你，注册成功！','active.php?active='.$_clean['active']);
	}else{
		mysql_close();
		_location('很遗憾，注册失败！','reg.php');
	}
}
//唯一标识符，每台电脑都会产生不一样的标识符
$_SESSION['uniqid']=$_uniqid=_sha1_uniqid();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二手交易平台会员注册</title>
<link rel="stylesheet" href="styles/reg.css">
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
<div class="reg-wrap">
    <header>
        <h1><a href="index.php" class="logo">N J U E </a></h1>
    </header>
    
    <div class="reg-cont">
        <h2>新用户注册</h2>
        <div class="register">
        <form method="post" action="reg.php?action=register">
        <input type="hidden" name="uniqid" value="<?php echo $_uniqid;?>" />
        <dl>
            <dd><span class="label"><label for="username">用 户 名：</label></span>
                <input type="text" id="username" name="username" class="text" />
                <span class="info info-user">5-25个字符，一个汉字为2个字符</span>
                <span class="info info-null">不能为空</span>
                <span class="info info-num">5-25个字符</span>
                <span class="info info-">包含非法字符</span>
                <span class="info ">该会员名已被使用</span>
                <span class="info ">一旦注册成功不能修改</span>
            </dd>
            <dd><span class="label"><label for="userpwd">密    码：</label></span>
                <input type="password" id="userpwd" name="password" class="text" />
            </dd>
            <dd><span class="label"><label for="notpwd">密码确认：</label></span>
                <input type="password" id="notpwd" name="notpwd" class="text" />
            </dd>
            <dd><span class="label"><label for="email">注册邮箱：</label></span>
                <input type="text" id="email" name="email" class="text" />
            </dd>
            <dd><span class="label"><label for="icode">验 证 码：</label></span>
                <input type="text" id="icode" name="icode" class="text icode" /><img src="code.php" id="code" />
            </dd>
        </dl>
        <div class="sub-form">
        <button class="submit" type="submit">注册</button>
        </div>
        </form>
    </div>
</div>
</body>
</html>