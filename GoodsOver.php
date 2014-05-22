<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?PHP 
  //从数据库中批量删除公告信息
  //读取要删除的公告编号
  include('class\Goods.php');
  $gid=$_GET["gid"];
  $obj = new Goods();
  $obj->SetOver($gid);
  print("商品交易已结束!");
?>
</form>
</body>
<script language="javascript">
  opener.location.reload();
  setTimeout("window.close()",600);
</script>
</html>
















