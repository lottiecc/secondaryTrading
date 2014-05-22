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
        <div id="basic-info">
            <form name="modify" id="modify" method="post" action="?modify">
            <dl>
            <dd>昵称：<?php echo $_username;?></dd>
            <dd>真实姓名：<input type="text" value="" /></dd>
            <dd>学号：<input type="text" value="" /></dd>
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
        <?php
		
		if(isset($_GET['action'])&&$_GET['action']=='photo'){
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
        <div id="photo">
			<form enctype="multipart/form-data" method="post" action="my_data.php?action=photo">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            上传头像：<input type="file" id="up-photo" name="userfile" />
            <input type="submit" value="上传" />
            </form>
        </div>
           
        
        <div id="check-pwd">
            <form id="pwd" method="post" action="">
            <dd>原密码：<input type="password" id="oldpwd" /></dd>
            <dd>新密码：<input type="password" id="newpwd" /></dd>
            <dd>确认新密码：<input type="password" id="confpwd" /></dd>
            <dd><input type="button" id="conf" value="修改" /></dd>
            </form> 
        </div>   
    </div>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>