<?php
session_start();
//定义个常量，用来授权调用includes里面的文件
define('IN_ST',true);
//定义个常量，用来指定本页的内容
define('SCRIPT','publish');
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//是否正常登录
if(!isset($_COOKIE['username'])){
	header('Location:login.php');
}else{
	$_rows=_fetch_array("SELECT st_username FROM st_user WHERE st_username='{$_COOKIE['username']}'");
	$_username=$_rows['st_username'];
}

?>
<?php
include('class/Goods.php');
if(isset($_GET['action'])&&$_GET['action']=='publish'){
	$obj=new Goods();
	$obj->GoodsName=$_POST['gtitle'];
	$obj->TypeId=$_POST['typeid'];
	$obj->Price=$_POST['gprice'];
	$obj->GoodsDetail=$_POST['gdetail'];
	$obj->SaleOrBuy='1';
	$obj->ImageURL=$_POST['url'];
	$obj->StartTime=date("Y-m-d H:i:s");
	$obj->OldNew='七成';
	$obj->PayMode='现金';
	$obj->DeliverMode='书香地';
	$obj->IsOver='0';
	$obj->OwerId=$_POST['owerid'];
	$obj->insert();
	print('商品发布成功！');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<?php 
	require ROOT_PATH.'includes/title.inc.php';
?>
<script type="text/javascript" src="js/addImg.js"></script>
</head>

<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div id="pubMain">
    <form name="" method="post" action="want_to_publish.php?action=publish" >
    <p>标题：<input type="text" name="gtitle" class="in" /></p>
    <input type="hidden" name="owerid" value="<?php echo $_username; ?>" />
    <p>类目：<select name="typeid" class="in">
    <?PHP
      include('class/GoodsType.php');
      $obj = new GoodsType();
      $results = $obj->GetGoodsTypelist();
      while($row = $results->fetch_row())
      {
    ?><option value="<?PHP   echo($row[0]); ?>"><?PHP   echo($row[1]); ?></option>  
      <?PHP   } ?>  
    </select></p>
    <p>新旧：<input type="button" name="1" value="非全新" />
            <input type="button" name="2" value="全新" />
    </p>
    <p>价格：<input type="text" name="gprice" class="in" /></p>
    <p>联系方式：<input type="text" name="gtel" class="in" value="手机号：" />
            <input type="text" name="gname" class="in" value="姓名：" /></p>
    <p>宝贝图片：<input type="text" name="url" id="url" class="in" readonly="readonly" value="" /><a href="javascript:;" id="upload">上传</a></p>
    <p>宝贝描述：<input type="text" class="in" name="gdetail" /></p>
    <p id="PayMode">交易方式：<input type="button" name="1" value="见面交易" /><input type="button" name="2" value="线上交易" /></p>
    <input type="submit" name="sub" class="submit" value="立即发布" />
    </form>
</div>

<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>