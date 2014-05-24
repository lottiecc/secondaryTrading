<?php 
include 'components/header.php';
?>

<?php
require_once 'medoo.php';
$database = new medoo('secondarytrading');
$types = $database->select("st_goodstype","*");
$count = $database->count("st_goodstype");
?>

<table>
	<tr>
		<td>类目ID</td>
		<td>类目名称</td>
		<td>操作</td>
	</tr>
<?php foreach($types as $type) { ?>
	<tr>
		<td><?php echo $type['typeId'] ?></td>
		<td><?php echo $type['typeName'] ?></td>
		<td>
			<a href="javascript:confirmOper(
				'update',
				'<?php echo $type["typeId"]?>',
				'<?php echo $type["typeName"]?>')">
				修改</a>
			<a href="javascript:confirmOper(
				'delete',
				'<?php echo $type["typeId"]?>',
				'<?php echo $type["typeName"]?>')">
				删除</a>
		</td>
	</tr>
<?php }?>
	<tr>
		<td colspan="3">
		<form method="get" action="typeService.php">
			<input type="hidden" name="oper" value="add" />
			<input placeholder="新增类目" type="text" name="name" />
			<input type="submit" value="新增" />
		</form>
		</td>
	</tr>
</table>

<script>
function confirmOper(oper,id,message){
	if(oper=="delete"){
		if(confirm("确定要删除类目：" + message)){
			top.location = "typeService.php?oper=delete&id=" + id;
		}
	}else if(oper=="update"){
		var name = prompt("请输入修改后的类目名称：",message);
		if(name!=null && name!=""){
			top.location = "typeService.php?oper=update&id=" + id + "&name=" + name;
		}
	}
}
</script>
<?php
include 'components/footer.php';
?>
