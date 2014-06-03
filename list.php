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



include 'includes/pagination.func.php';
		$pageSize=12;
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
?>
<div id="list-main">
	<div class="cat">
		<ul class="cat1" id="cat1">
			<li>图书办公</li>
			<li>电器数码</li>
			<li>运动户外</li>
			<li>服饰美妆</li>
			<li>生活杂货</li>
		</ul> 


		<div class="sub-cat" id="subCat">
			<ul class="sub1">
				<li><a href="list.php?tid=6">教辅资料</a></li>
				<li><a href="list.php?tid=8">英语等级</a></li>
				<li><a href="list.php?tid=9">考证书籍</a></li>
				<li><a href="list.php?tid=10">杂志小说</a></li>
				<li><a href="list.php?tid=11">纸本文具</a></li>
			</ul>
			<ul class="sub2">
				<li><a href="list.php?tid=12">宿舍电器</a></li>
				<li><a href="list.php?tid=13">手机电脑</a></li>
				<li><a href="list.php?tid=14">相机音响</a></li>
				<li><a href="list.php?tid=15">其他数电</a></li>
			</ul>
			<ul class="sub3">
				<li><a href="list.php?tid=16">自行车</a></li>
				<li><a href="list.php?tid=17">轮滑滑板</a></li>
				<li><a href="list.php?tid=18">球类运动</a></li>
				<li><a href="list.php?tid=19">户外装备</a></li>
			</ul>
			<ul class="sub4">
				<li><a href="list.php?tid=20">服装鞋帽</a></li>
				<li><a href="list.php?tid=21">美妆护肤</a></li>
				<li><a href="list.php?tid=22">饰品箱包</a></li>
			</ul>
			<ul class="sub5">
				<li><a href="list.php?tid=23">其他</a></li>
			</ul>
		</div>
	</div>
<script type="text/javascript" src="js/byClass.js"></script>
<script>
window.onload=function(){
	var oCat1=document.getElementById('cat1');
	var aLi=oCat1.getElementsByTagName('li');
	var oSubCat=document.getElementById('subCat');
	var aUl=oSubCat.getElementsByTagName('ul');
	for(var i=0;i<aLi.length;i++){
		aLi[i].index=i;
		aLi[i].timer=null;
		aUl[i].index=i;
		aLi[i].onmouseover=function(){
			for(var i=0;i<aLi.length;i++){
				clearTimeout(aLi[i].timer);
				removeClass(aLi[i],"active");
				removeClass(aUl[i],"show");
			}
			addClass(this,"active");
			addClass(aUl[this.index],"show");
		};
		aUl[i].onmouseout=aLi[i].onmouseout=function(){
			var index=this.index;
			aLi[index].timer=setTimeout(function(){
				removeClass(aUl[index],"show");
				removeClass(aLi[index],"active");
				aLi[index].timer=null;
			},50);
		};
		aUl[i].onmouseover=function(){
			clearTimeout(aLi[this.index].timer);
		};
	}
}
</script>
	<div class="list-nav">
		<ul>
            <li><a href="javascript:;" class="on">最新</a><span>|</span></li>
            <!--<li><a href="javascript:;">价格 ↑</a><span>|</span></li>
            <li><a href="javascript:;">价格 ↓</a></li>-->
        	<li class="important">
				<div class="cont-search" id="contSearch">
			        <form action="list.php">
			        <input class="search-input" type="text" value="<?php echo $search; ?>" autocomplete="off" name="search" id="search">
			        <input class="search-submit" type="submit" value="">
			        <p class="search-icon" title="搜索所需的物品"><i></i></p>
			        </form>
			    </div>
			</li>
	    </ul>
	</div>
	<div id="listCont">
		<ul class="goods-list" id="goodsList">
		<?php
		
		
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
			<div class="goods-img">
				<a href="item.php?gid=<?php echo $row[0]; ?>">
				<img src="upimg/<?php echo $row[4]; ?>" />
				</a>
			</div>
			<p><?php echo $row[2]; ?></p>
		</li>
		<?php
		}
		?>
		</ul>
		<ul class="page-list" id="pageList">
		<?php echoPagination($pageNo,$pageSize,$count,"search=".$search); ?>
		</ul>
	</div>
</div>

<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
<script type="text/javascript">

	// window.onload=function(){
	// 	var oUl=document.getElementById('goodsList');
	// 	var aLi=oUl.getElementsByTagName('li');
	// 	var aHeight={F:[],S:[],T:[],L:[]};
	// 	var bBtn=true;

	// 	for(var i=0;i<aLi.length;i++){
	// 		var iNow=i%4;

	// 		switch(iNow){
	// 			case 0:
	// 				aLi[i].style.left='5px';

	// 				aHeight.F.push(aLi[i].offsetHeight);

	// 				var step=Math.floor(i/4);

	// 				if(!step){
	// 					aLi[i].style.top=0;
	// 				}
	// 				else{
	// 					var sum=0;
	// 					for(var j=0;j<step;j++){
	// 						sum+=aHeight.F[j]+5;
	// 					}
	// 					aLi[i].style.top=sum+'px';
	// 				}

	// 			break;
	// 			case 1:
	// 				aLi[i].style.left='255px';

	// 				aHeight.S.push(aLi[i].offsetHeight);

	// 				var step=Math.floor(i/4);

	// 				if(!step){
	// 					aLi[i].style.top=0;
	// 				}
	// 				else{
	// 					var sum=0;
	// 					for(var j=0;j<step;j++){
	// 						sum+=aHeight.S[j]+5;
	// 					}
	// 					aLi[i].style.top=sum+'px';
	// 				}

	// 			break;
	// 			case 2:
	// 				aLi[i].style.left='505px';

	// 				aHeight.T.push(aLi[i].offsetHeight);

	// 				var step=Math.floor(i/4);

	// 				if(!step){
	// 					aLi[i].style.top=0;
	// 				}
	// 				else{
	// 					var sum=0;
	// 					for(var j=0;j<step;j++){
	// 						sum+=aHeight.T[j]+5;
	// 					}
	// 					aLi[i].style.top=sum+'px';
	// 				}

	// 			break;
	// 			case 3:
	// 				aLi[i].style.left='755px';

	// 				aHeight.L.push(aLi[i].offsetHeight);

	// 				var step=Math.floor(i/4);

	// 				if(!step){
	// 					aLi[i].style.top=0;
	// 				}
	// 				else{
	// 					var sum=0;
	// 					for(var j=0;j<step;j++){
	// 						sum+=aHeight.L[j]+5;
	// 					}
	// 					aLi[i].style.top=sum+'px';
	// 				}


	// 			break;
	//		}
	//	}

	//}
</script>

</body>
</html>




