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
}

// 获取当前登录用户信息
include_once('class/Users.php');
$user = new Users();
$user->GetUsersInfo($_COOKIE['username']);

// 个人资料修改
$modifyState=0;
$oper = "";
if(isset($_POST['modify'])){
	$oper = $_POST['modify'];
	if($oper == "personalData"){
		$user->RealName = $_POST['RealName'];
		if($_POST['Email'] != ''){
			$user->Email = $_POST['Email'];
		}
		$user->Phone = $_POST['Phone'];
		$user->QQ = $_POST['QQ'];
		if($user->update($user->UserId)){
			$modifyState = 1;
		}
	} else if($oper == "password"){
		if($_POST['newPassword'] == $_POST['newPasswordAgain'] 
				&& strlen($_POST['newPassword']) > 5
				&& $_POST['oldPassword'] == $user->Password
				&& $user->changePassword($user->UserId,$_POST['oldPassword'],$_POST['newPassword'])){
			$modifyState = 2;
		}else{
			$modifyState = 3;//表示保存失败
		}
	}
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
    <p class="member-cont">个人中心 - <span>我的资料</span></p>
    <ul>
    <li><a href="#">基本资料</a></li>
    <li><a href="#">头像照片</a></li>
    <li><a href="#">密码修改</a></li>
    </ul>
    <form method="post" action="">
		<input type="hidden" name="modify" value="personalData" />
		<dl>
			<dd><span>昵称：</span><?php echo $user->UserName;?></dd>
			<dd><span>真实姓名：</span><input type="text" name="RealName" value="<?php echo $user->RealName;?>" /></dd>
			<dd><span>E-Mail：</span><input type="text" name="Email" value="<?php echo $user->Email;?>" /></dd>
			<dd><span>手机号：</span><input type="text" name="Phone" value="<?php if($user->Phone != 0)echo $user->Phone;?>" /></dd>
			<dd><span>QQ：</span><input type="text" name="QQ" value="<?php echo $user->QQ;?>" /></dd>
			<dd><input class="sub" type="submit" value="保存" /><?php if($modifyState == 1) echo "修改成功";?></dd>
		</dl>
    </form>
	<?php
	if($oper == "photo") {
		//设置上传图片类型
		$files=array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
		//判断类型是数组中的一种
		if(is_array($files)){
			if(!in_array($_FILES['userfile']['type'],$files)){
				echo "<script>alert('只允许上传jpg,gif,png图片中的一种！'); history.back();</script>";
				exit; 
			}
		}
		
		//获取文件的扩展名
		$n=explode('.',$_FILES['userfile']['name']);
		$name=time().'.'.$n[1];
		//移动文件
		if(is_uploaded_file($_FILES['userfile']['tmp_name'])){ 
			if(!@move_uploaded_file($_FILES['userfile']['tmp_name'],'images/photo/'.$name)){
				echo "<script>alert('移动失败'); history.back(); </script>";
				exit;
			}else{
				mysql_query("UPDATE st_user SET st_photo='".$name."' WHERE st_username='".$_COOKIE['username']."';")or die("sql wrong".mysql_error());
				echo "<script>alert('上传成功！');
							  window.close();
					  </script>";
				exit;
			}
		}else{
			echo "<script>alert('上传的临时文件不存在！'); history.back(); </script>";
		}
	}
	?>
	<form enctype="multipart/form-data" method="post" action="">
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<input type="hidden" name="modify" value="photo" />
		上传头像：<input type="file" id="up-photo" name="userfile" />
		<input type="submit" value="上传" />
	</form>
	<form method="post" action="" onsubmit="return passwordValidator()">
		<input type="hidden" name="modify" value="password" />
		<dl>
			<dd><span>原密码：</span><input type="password" name="oldPassword"/></dd>
			<dd><span>新密码：</span><input type="password" name="newPassword"/></dd>
			<dd><span>确认新密码：</span><input type="password" name="newPasswordAgain"/></dd>
			<dd>
				<input class="sub" type="submit" value="保存" />
				<?php 
					if($modifyState == 2) echo "修改成功";
					else if($modifyState == 3) echo "修改失败";
				?>
			</dd>
		</dl>
	</form>
	<script>
		function passwordValidator(){
			var oldPassword = document.getElementsByName('oldPassword')[0].value;
			var newPassword = document.getElementsByName('newPassword')[0].value;
			var newPasswordAgain = document.getElementsByName('newPasswordAgain')[0].value;
			if(newPassword != newPasswordAgain){
				alert("两次密码不一致");return false;
			}
			if(newPassword.length < 6){
				alert("密码至少6位");return false;
			}
			return true;
		}
	</script>
    </div>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>