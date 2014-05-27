<?php
//定义一个常量，用来授权调用includes里的文件
define('IN_ST',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','list');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';  //转换成硬路径，引入速度更快
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品列表</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
</head>


<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div id="listCont">
<ul class="goods-list" id="goodsList">
<?php
include 'includes/pagination.func.php';
$cond = "";
$search = "";//查询词
$tid = "";//类目id
//读取参数，tid表示商品类型
if(isset($_GET['tid']) && $_GET['tid'] != ""){
	$tid = $_GET['tid'];
	$cond = $cond."typeId=".$tid." ";
}
if(isset($_GET['search']) && $_GET['search'] != ""){
	$search = $_GET['search'];
	if($cond != "")$cond=$cond."AND ";
	$cond = $cond."goodsName LIKE '%".$search."%' ";
}
if($cond != ""){
	$cond = "WHERE ".$cond;
}
include('class/Goods.php');
$obj=new Goods();
$results=$obj->SearchGoods($cond,$OFFSET,$pageSize);
$count = $obj->CountGoods($cond);
while($row = $results->fetch_row()){
?>
<li> 
	<a href="item.php?gid=<?php echo $row[0]; ?>">
	<img src="upimg/<?php echo $row[4]; ?>" />
	<p><?php echo $row[2]; ?></p>
	</a>
</li>
<?php
}
?>
</ul>
</div>
<?php echoPagination($pageNo,$pageSize,$count,"search=".$search); ?>
<script type="text/javascript">
	window.onload=function(){
		var oUl=document.getElementById('goodsList');
		var aLi=oUl.getElementsByTagName('li');
		var aHeight={F:[],S:[],T:[],L:[]};
		var bBtn=true;

		for(var i=0;i<aLi.length;i++){
			var iNow=i%4;

			switch(iNow){
				case 0:
					aLi[i].style.left='5px';

					aHeight.F.push(aLi[i].offsetHeight);

					var step=Math.floor(i/4);

					if(!step){
						aLi[i].style.top=0;
					}
					else{
						var sum=0;
						for(var j=0;j<step;j++){
							sum+=aHeight.F[j]+5;
						}
						aLi[i].style.top=sum+'px';
					}

				break;
				case 1:
					aLi[i].style.left='255px';

					aHeight.S.push(aLi[i].offsetHeight);

					var step=Math.floor(i/4);

					if(!step){
						aLi[i].style.top=0;
					}
					else{
						var sum=0;
						for(var j=0;j<step;j++){
							sum+=aHeight.S[j]+5;
						}
						aLi[i].style.top=sum+'px';
					}

				break;
				case 2:
					aLi[i].style.left='505px';

					aHeight.T.push(aLi[i].offsetHeight);

					var step=Math.floor(i/4);

					if(!step){
						aLi[i].style.top=0;
					}
					else{
						var sum=0;
						for(var j=0;j<step;j++){
							sum+=aHeight.T[j]+5;
						}
						aLi[i].style.top=sum+'px';
					}

				break;
				case 3:
					aLi[i].style.left='755px';

					aHeight.L.push(aLi[i].offsetHeight);

					var step=Math.floor(i/4);

					if(!step){
						aLi[i].style.top=0;
					}
					else{
						var sum=0;
						for(var j=0;j<step;j++){
							sum+=aHeight.L[j]+5;
						}
						aLi[i].style.top=sum+'px';
					}


				break;
			}
		}

	}
</script>

</body>
</html>




