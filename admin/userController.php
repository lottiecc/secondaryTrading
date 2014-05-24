<?php 
include 'components/header.php';
?>

<?php
require_once 'medoo.php';
include 'pagination.php';

$database = new medoo('secondarytrading');
$users = $database->select("st_user","*",["LIMIT"=>[$OFFSET,$LIMIT]]);
$count = $database->count("st_user");
?>
<table>
	<tr>
		<td>ID</td>
		<td>用户名</td>
		<td>性别</td>
		<td>真实姓名</td>
		<td>学号</td>
		<td>E-MAIL</td>
		<td>用户类型</td>
		<td>操作</td>
	</tr>
<?php foreach($users as $user) { ?>
	<tr>
		<td><?php echo $user['st_id'] ?></td>
		<td><?php echo $user['st_username'] ?></td>
		<td><?php if($user['st_sex']==1)echo '男';else echo '女'; ?></td>
		<td><?php echo $user['st_realname'] ?></td>
		<td><?php echo $user['st_realnumber'] ?></td>
		<td><?php echo $user['st_email'] ?></td>
		<td><?php if($user['UserType']==1)echo '管理员';else echo '普通用户'; ?></td>
		<td>
			<?php if($user['UserType']!=1){ ?>
			<a href="javascript:confirmDelete('<?php echo $user["st_id"]?>','<?php echo $user["st_username"]?>')">删除</a>
			<?php }?>
		</td>
	</tr>
	<tr>
		<td colspan="7">
<?php
}
echoPagination($pageNo,$pageSize,$count);
?>
		</td>
	</tr>
</table>

<script>
function confirmDelete(id,message){
	if(confirm("确定要删除用户：" + message + "?")){
		top.location = "userService.php?st_id=" + id;
	}
}
</script>
<?php
include 'components/footer.php';
?>
