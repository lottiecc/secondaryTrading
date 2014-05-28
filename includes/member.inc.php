<?php
if(!defined('IN_ST')){
	exit('Access Defined!');
}
?>
<script type="text/javascript">
window.onload=function(){
	var oDd=document.getElementsByTagName('dd');
	for(var i=0;i<oDd.length;i++){
		oDd[i].onclick=function(){
				oDd[i].style.className='active';
		
		}
	}
}
</script>
<div id="member_sidebar">
<?php
 include_once('class/Users.php');
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

<dl>
<dd><a href="my_release.php">我的发布</a></dd>
<dd><a href="member.php">个人资料</a></dd>
</dl>
</div>