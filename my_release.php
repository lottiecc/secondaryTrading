<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_ST',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','member');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/my_release.js"></script>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
<link rel="stylesheet" href="styles/release.css">
<title>NJUE二手交易--已发布商品</title>
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
        <?php
        include('includes/pagination.func.php');
        include('class/Goods.php');
        $obj=new Goods();
        $cond=" WHERE ownerId='{$_COOKIE['username']}'";
        $search = "";
        if(isset($_GET['search'])){
        	$search = $_GET['search'];
        	if($search != null && $search != ""){
        		$cond = $cond . " AND goodsName LIKE '%".$search."%' ";
        	}
        }
        $pageSize = 6;
        $results=$obj->SearchGoods($cond,$OFFSET,$pageSize);
        $count = $obj->CountGoods($cond);
        ?>
        <p class="member-cont">个人中心 - <span>我的发布</span></p>
        <div class="member-pub"><a href="want_to_publish.php">我要发布</a></div>
        <!--<form method="get" action="my_release.php">
        	<input type="text" name="search" placeholder="请输入内容..." value="<?php echo $search;?>" />
        	<input type="submit" value="搜索"/>
        </form>
        -->
        <form name="goods-list" action="" method="post">
            <table>
            <thead>
                <tr>
					<th>图片</th>
                    <th class="baobei">宝贝</th>
                    <th class="price">价格</th>
                    <th class="operate">操作</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($row=$results->fetch_array()){
            	if($row[4]){
            ?>
                <tr class="pub-list">
                    <td class="list-pic">
                    <a class="pic" href="item.php?gid=<?php echo $row['goodsId'];?>" target="_blank">
						<img src="upimg/<?php echo $row[4];   //商品图片?>  " class="list-img" height="50" width="50" alt="查看宝贝详情" />
					</a>
            		</td>
			<?php }?>
            		<td>
							<a class="" href="item.php?gid=<?php echo $row['goodsId'];?>" target="_blank"><?php echo $row['goodsName'];  //商品名称?></a>
                    </td>
                    <td>
                    &yen;<?php echo $row['price'];   //价格 ?>
                    </td>
                    <td class="list-op">
					<?php
						if($row['isOver']){
							echo '已结束';
						} else {
					?>
                    <a href="GoodsEdit.php?gid=<?php echo($row['goodsId']); ?>">修改</a>
                    <a href="GoodsOver.php?gid=<?php echo($row['goodsId']); ?>" target="_blank">结束</a>
					<?php
						}
					?>
                    <a href="GoodsDelt.php?gid=<?php echo($row['goodsId']); ?>" target="_blank">删除</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td class="page-nav-cell">
            		<?php echoPagination($pageNo,$pageSize,$count); ?>
                    </td>
                </tr>
            </tfoot>
            </table>
        </form>
    </div>
</div>
<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>