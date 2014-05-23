<?php
session_start();
if(!isset($_COOKIE["username"]) || !isset($_COOKIE["UserType"]) || $_COOKIE["UserType"]!=1){
	header('location:login.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>二手交易平台后台管理系统</title>

<style>
body {
	margin:0;
}
.header {
	margin:0 0 10px 0;
	padding:10px 30px;
	background:blue;
}
</style>
</head>
<body>
	<div class="header">
		欢迎来到二手交易平台后台管理系统
		<?php
			echo $_COOKIE["username"];
		?>
		<a href="login.php?action=logout"><font style="color:yellow">退出</font></a>
	</div>
	<table style="width:100%">
		<tr>
			<td style="width:20%; max-width:200px;">
				<?php include 'menu.php'; ?>
			</td>
			<td style="width:80%;">