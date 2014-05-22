<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品详情</title>
<link rel="stylesheet" type="text/css" href="styles/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/item.css" />
</head>
<?php
//定义一个常量，用来授权调用includes里的文件
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';  //转换成硬路径，引入速度更快
?>

<?php
include('class/Goods.php');
$obj=new Goods();
$gid=$_GET['gid'];
$obj->GetGoodsInfo($gid);
?>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div class="content">
	<ul class="dt-top">
    	<li class="dt-top-left">
        	<h3><?php echo($obj->GoodsName);?></h3>
            <p>
            	<span>物品分类：</span>
                <a href="list.php?">{商品分类}</a>
            </p>
            <p>
                <span>价格：</span><?php echo $obj->Price; ?>
            </p>
            <p>
                <span>配送地：</span><?php echo $obj->DeliverMode; ?>
            </p>
            <ul>
                <li>
                    <span class="dt-v"><i></i>{查看次数}</span>
                    <span class="dt-c"><i></i>{收藏次数}</span>
                </li>
            </ul>
          </li>
          <li class="dt-top-right">
          	<div class="user-avatar">
            	<img class="user-avatar-img" src="images/noimg.png" />
            </div>
            <div class="list-author">
            	<h3><a id="user-nick" href="user.php?id={用户id}"><?php echo $obj->OwerId; ?></a></h3>
                <p><a href=""><em id="user-sub">{商品数量}</em></a><span>闲置物品</span></p>
            </div>
            <div class="user-info">
            <span>联系看看</span>
            </div>
          </li>
        </ul>
        <ul class="pub-time">发布时间：<?php echo $obj->StartTime; ?></ul>
        <ul id="itemCont" class="dt-cont">
        <div><p><?php echo $obj->GoodsDetail; ?>{插入物品文字描述}</div>
        <img src="upimg/<?php echo($obj->ImageURL);?>" />
        </ul>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>