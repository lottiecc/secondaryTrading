<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品分类</title>
</head>

<body>
<form method="post">
<?php 
include('../class/Goods.php');
include('../class/GoodsType.php');
$objGoods=new Goods();
$objType=new GoodsType();
//处理添加，修改和删除操作
$Operate=$_GET['Oper'];
$Operid=$_GET['tid'];
//删除
if($Operate=='delete'){
	//判断商品表中是否存在此分类
	if($objGoods->HaveGoodsType($Operid)){
		exit('此分类包含商品信息，不能删除');
	}else{
		$objType->delete($Operid);
		exit('此分类已成功删除');
	}
}
//添加
else if($Operate=='add'){
	$Name=$_POST['addClassify'];
	//判断商品列表中是否存在此分类	
	if($objType->HaveGoodsType($Name)){
		echo('此分类已存在！');
	}else{
		$objType->typeName=$Name;
		$objType->insert();
	}
}
	
		
?>
<table>
<caption>商品分类管理</caption>
<tr>
<th>分类名称</th>
<th>修改</th>
<th>删除</th>
</tr>
<?php
//读取分类数据
$results=$objType->GetGoodsTypeList();
$exist=false;
//在表格中显示分类名称
while($rows=$results->fetch_row()){
	$exist=true;
	?>
    <tr>
    <td><?php echo $rows[1]; ?></td>
    <td><a href="TypeList.php?Oper=update&tid=<?php echo $rows[0]; ?>">修改</a></td>
    <td><a href="TypeList.php?Oper=delete&tid=<?php echo $rows[0]; ?>">删除</a></td>
    </tr>
    <?php 
}
if(!$exist){
?>
	<tr>
    <td colspan="3">目前还没有记录</td>
    </tr>
    <?php
}
?>
</table>
</form>
<form method="post" action="TypeList.php?Oper=add">
<p>添加分类：<input type="text" name="addClassify" /><input type="submit" name="submit" value="添加" /></p>
</form>

</body>
</html>