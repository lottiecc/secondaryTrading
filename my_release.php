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
<div>
<?php
include('includes/pagination.php');
include('class/Goods.php');
$obj=new Goods();
$cond=" WHERE owerId='{$_COOKIE['username']}'";
$pageSize = 6;
$results=$obj->SearchGoods($cond,$OFFSET,$pageSize);
$count = $obj->CountGoods($cond);
?>
<input type="button" id="fabu" name="fabu" value="我要发布" />
<form name="goods-list" action="" method="post">
<table>
<thead>
    <tr>
        <th></th>
        <th>宝贝图片</th>
		<th>宝贝名称</th>
        <th>价格</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
<?php
while($row=$results->fetch_row()){
	if($row[5]){
		?>
    <tr>
        <td colspan="2">
        <a class="" href=""><img src="upimg/<?php echo $row[5];   //商品图片?> " height="50" width="50" alt="查看宝贝详情" /></a><?php }?>
		</td>
		<td>
        <div class="desc">
        <a class="" href="" target=""><?php echo $row[3];  //商品名称?></a>
        </div>
        </td>
        <td>
        <?php echo $row[6];   //价格 ?>
        </td>
        <td>
        <a href="GoodsEdit.php?gid=<?php echo($row[0]); ?>">修改</a>
        <a href="GoodsDelt.php?gid=<?php echo($row[0]); ?>" target="_blank">删除</a>
        <a href="GoodsOver.php?gid=<?php echo($row[0]); ?>">结束</a>
        </td>
    </tr>
    <?php
}
?>
</tbody>
<tfoot>
    <tr>
        <td></td>
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