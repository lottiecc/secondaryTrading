<?php 
include 'components/header.php';
?>

<?php
require_once 'medoo.php';
include 'pagination.php';

$database = new medoo('secondarytrading');
$goodsList = $database->select("st_goods","*",["LIMIT"=>[$OFFSET,$pageSize]]);
$count = $database->count("st_goods");
?>
<table>
	<tr>
		<td>ID</td>
		<td>商品类目ID</td>
		<td>goodsName</td>
		<td>goodsDetail</td>
		<td>price</td>
		<td>startTime</td>
		<td>OldNew</td>
		<td>操作</td>
	</tr>
<?php foreach($goodsList as $goods) { ?>
	<tr>
		<td><?php echo $goods['goodsId'] ?></td>
		<td><?php echo $goods['typeId'] ?></td>
		<td><?php echo $goods['goodsName'] ?></td>
		<td><?php echo $goods['goodsDetail'] ?></td>
		<td><?php echo $goods['price'] ?></td>
		<td><?php echo $goods['startTime'] ?></td>
		<td><?php echo $goods['OldNew'] ?></td>
		
	</tr>
<?php }?>
	<tr>
		<td colspan="7">
			<?php
			echoPagination($pageNo,$pageSize,$count);
			?>
		</td>
	</tr>
</table>

<script>

</script>
<?php
include 'components/footer.php';
?>
