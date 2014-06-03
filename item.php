<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_ST',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','item');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';  //转换成硬路径，引入速度更快

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品详情</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>

<?php
include('class/Goods.php');
$obj=new Goods();
$gid=$_GET['gid'];
$obj->GetGoodsInfo($gid);
$tid=$obj->TypeId;
$unick=$obj->OwnerId;
include('class/GoodsType.php');
$objtype=new GoodsType();
$objtype->GetGoodsTypeInfo($tid);
include('class/Users.php');
$objUser=new Users();
$objUser->GetUsersInfo($unick);
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
                <a href="list.php?tid=<?php echo $objtype->typeId;?>"><?php echo $objtype->typeName; ?></a>
            </p>
            <p>
                <span>价格：</span>&yen;<?php echo $obj->Price; ?>
            </p>
            <p>
                <span>交易地点：</span><?php echo $obj->TradePlace; ?>
            </p>
            <!--<ul>
                <li>
                    <span class="dt-v"><i></i>{查看次数}</span>
                    <span class="dt-c"><i></i>{收藏次数}</span>
                </li>
            </ul>-->
          </li>
          <li class="dt-top-right">
          	<!--<div class="user-avatar">
            	<img class="user-avatar-img" src="images/noimg.png" />
            </div>-->
            <div class="list-author">
            	<h3>卖家信息</h3>
				<p><span>昵称：<?php echo $obj->OwnerId; ?></span></p>
                        
                <p><span>联系：<?php echo $objUser->RealName; ?>同学</span></p>
    			<?php if($objUser->Phone != ""){ ?>
    			<p><span>TEL：<?php echo $objUser->Phone; ?></span></p>
    			<?php }?>
    			<?php if($objUser->Email != ""){ ?>
    			<p><span>邮箱：<?php echo $objUser->Email; ?></span></p>
    			<?php }?>
    			<?php if($objUser->QQ != ""){ ?>
    			<p><span>QQ：<?php echo $objUser->QQ; ?></span></p>
    			<?php }?>

            <!--    <p><span>已发布</span><span><a href="">{商品数量}</a>个</span><span>闲置物品</span></p>-->
            </div>
            <!--<div class="info">
                <div class="user-info" id="userInfo">
                    <span>联系看看</span>
                </div>
                <div class="tel-info">
                    <span><?php echo $objUser->RealName; ?>同学</span>
                    <span>tel：<?php echo $objUser->Phone; ?></span>
                 </div>
             </div>-->
          </li>
        </ul>
        <ul class="pub-time">发布时间：<?php echo $obj->StartTime; ?></ul>
        <ul id="itemCont" class="dt-cont">
        <div><p><?php echo $obj->GoodsDetail; ?></p></div>
        <img id="contImage" src="upimg/<?php echo($obj->ImageURL);?>" />
        </ul>
</div>
<script type="text/javascript">
	window.onload=function(){
		var oItemCont=document.getElementById('itemCont');
		var oContImage=document.getElementById('contImage');
		var t=(oItemCont.clientWidth-oContImage.offsetWidth)/2;
		var h=oContImage.offsetHeight;
		oContImage.style.left=t+"px";
		oItemCont.style.height=h+200+'px';
	}
</script>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>

</body>
</html>