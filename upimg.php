<?php
//执行上传图片功能
if(isset($_GET['action'])&&$_GET['action']=='up'){
	//设置上传图片类型
	$files=array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');
	//判断类型是数组中的一种
	if(is_array($files)){
		if(!in_array($_FILES['userfile']['type'],$files)){
			echo "<script>alert('只允许上传jpg,gif,png图片中的一种！'); history.back();</script>";
			exit;      //可以换成_alert_back()
		}
	}
	
	//判断文件错误类型
	if($_FILES['userfile']['error']>0){
		switch($_FILES['userfile']['error']){
			case 1:echo "<script>alert('上传文件超过约定值1'); history.back(); </script>";  
																//都可换成_alert_back()
				break;
			case 2:echo "<script>alert('上传文件超过约定值2'); history.back(); </script>";
				break;
			case 3:echo "<script>alert('部分被上传'); history.back(); </script>";
				break;
			case 4:echo "<script>alert('没有任何文件被上传'); history.back(); </script>";
				break;
		}
		exit;
	}
	
	//判断配置大小
	if($_FILES['userfile']['size']>1000000){
		echo "<script>alert('上传的文件不得超过1M'); history.back(); </script>";
	}
	
	//获取文件的扩展名
	$n=explode('.',$_FILES['userfile']['name']);
	$name=time().'.'.$n[1];
	
	//移动文件
	if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
		if(!@move_uploaded_file($_FILES['userfile']['tmp_name'],'upimg/'.$name)){
			echo "<script>alert('移动失败'); history.back(); </script>";
			exit;
		}else{
			echo "<script>alert('上传成功！');
						  window.opener.document.getElementById('url').value='$name';
						  window.close();
				  </script>";
			exit;
		}
	}else{
		echo "<script>alert('上传的临时文件不存在！'); history.back(); </script>";
	}
	
}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div id="upimg">
<form enctype="multipart/form-data" action="upimg.php?action=up" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
选择图片：<input type="file" name="userfile" />
<input type="submit" value="上传" />
</form>
</div>
</body>
</html>