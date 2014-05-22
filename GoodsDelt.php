<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//从数据库中读取要删除的编号
include('class/Goods.php');
$gid=$_GET['gid'];
$obj=new Goods();
$obj->delete($gid);
print('删除商品信息成功！');
?>
<script type="text/javascript">
opener.location.reload();
setTimeout("window.close()",600);
</script>