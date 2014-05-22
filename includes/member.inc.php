<?php
if(!defined('IN_ST')){
	exit('Access Defined!');
}
?>
<script type="text/javascript">
var oDd=document.getElementsByTagName('dd');
for(var i=0;i<oDd.length;i++){
	oDd[i].onclick=function(){
			oDd[i].style.backgroundColor='#ff9';
	
	}
}
</script>
<div id="member_sidebar">
<?php
 include('class/Users.php');
 $objUser=new Users();
 $username=$_COOKIE['username'];
 $objUser->GetUsersInfo($username);
 if($objUser->Photo){	
?>
<img src="images/photo/<?php echo $objUser->Photo;?>" alt="头像" />
<?php
	}else{
?>
<img src="images/noimg.png" alt="头像" />
<?php }?>
<h2>账号管理</h2>
<dl>
<dd><a href="my_release.php">我的发布</a></dd>
<dd><a href="my_purchase.php">我的购买</a></dd>
<dd><a href="my_collection.php">我的收藏</a></dd>
<dd><a href="my_data.php">个人资料</a></dd>
<dd><a href="my_trade.php">交易信息</a></dd>
</dl>
</div>