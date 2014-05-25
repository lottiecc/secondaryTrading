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
  <div class="pub-cont">
    <h2>发布商品</h2>
    <form name="" method="post" action="want_to_publish.php?action=publish" >
    <div class="goods-cont">
    <p><span>标题</span><input type="text" name="gtitle" class="in" /></p>
    <input type="hidden" name="owerid" value="<?php echo $_username; ?>" />
    <p><span>类目</span><select name="typeid" class="typename">
    <?PHP
      include('class/GoodsType.php');
      $obj = new GoodsType();
      $results = $obj->GetGoodsTypelist();
      while($row = $results->fetch_row())
      {
    ?><option value="<?PHP   echo($row[0]); ?>"><?PHP   echo($row[1]); ?></option>  
      <?PHP   } ?>  
    </select></p>
    <p><span>新旧程度</span><input type="text" name="oldnew" class="in" placeholder="请填写1-10之间的数字" />
    </p>
    <p><span>价格</span><input type="text" name="gprice" class="in" /></p>
    <p><span>宝贝图片</span><input type="text" name="url" id="url" class="in" readonly="readonly" value="" /><a href="javascript:;" id="upload">上传</a></p>
    <p style="height:160px;"><span>宝贝描述</span><textarea name="gdetail" ></textarea></p>
    <p id="PayMode"><span>交易地点</span><select name="tradeplace" class="tradeplace">
    <option value="">中苑</option>
    <option value="">西苑</option>
    <option value="">东苑</option>
    <option value="">北苑</option>
    <option value="">教学区域</option>
    </select>
    </p>
    </div>

    <div class="user-cont">
    联系方式：（手机和QQ必填其一）
    <hr>
      <p><span>姓</span><input type="text" name="gname" class="in" /></p>
      <p><span>手机</span><input type="text" name="gtel" class="in" /></p>
      <p><span>QQ</span><input type="text" name="gqq" class="in"></p>
    </div>
    
    <input type="submit" name="sub" class="submit" value="立即发布" />
    </form>
  </div>
</div>

<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>