<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="styles/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/index.css" />
<link rel="shortcut icon" href="favicon.ico" />
</head>
<?php
//定义一个常量，用来授权调用includes里的文件
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';  //转换成硬路径，引入速度更快
?>


<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div>
<ul>
<?php
//读取参数，tid表示商品类型
$tid=$_GET['tid'];
include('class/Goods.php');
$obj=new Goods();
$cond=" WHERE typeId=$tid";
$results=$obj->GetGoodsList($cond);
while($row=$results->fetch_row()){
?>
<li><img src="upimg/<?php echo $row[5]; ?>" width="200px" height="120px" /><p><?php echo $row[3]; ?></p></li>
<?php
}
?>
</ul>
</div>


</body>
</html>