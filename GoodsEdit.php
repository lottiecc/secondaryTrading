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
	$_rows=_fetch_array("SELECT st_username,st_id FROM st_user WHERE st_username='{$_COOKIE['username']}'");
	$_username=$_rows['st_username'];
  $_uid=$_rows['st_id'];
}

?>
<?php
include('class/Goods.php');
include('class/Users.php');
 $objUser=new Users();

if(isset($_GET['gid'])){
	$gid=$_GET['gid'];
	$obj=new Goods();
	$obj->GetGoodsInfo($gid);
}







if(isset($_GET['action'])&&$_GET['action']=='edit'){
	$obj=new Goods();
	$gid=$_POST['gid'];
	$obj->GoodsName=$_POST['gtitle'];
	$obj->TypeId=$_POST['typeid'];
	$obj->Price=$_POST['gprice'];
	$obj->GoodsDetail=$_POST['gdetail'];
	$obj->ImageURL=$_POST['url'];
	$obj->OldNew=$_POST['oldnew'];
	$obj->TradePlace=$_POST['tradeplace'];
	$obj->update($gid);


  $objUser->RealName=$_POST['gname'];
  $objUser->Phone=$_POST['gtel'];
  $objUser->update($_uid);
	echo "<script type='text/javascript'>alert('商品修改成功！');history.go(-2);</script>";
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NJUE二手交易——商品修改</title>
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
    <h2>修改商品</h2>
    <form name="" method="post" onsubmit="return validate_form(this)" action="GoodsEdit.php?action=edit" >
    <div class="goods-cont">
    <p><span>标题</span><input type="text" name="gtitle" class="in" value="<?php echo $obj->GoodsName; ?>" placeholder="最多20个字" /></p>
    <input type="hidden" name="gid" value="<?php echo $gid; ?>" />
    <p><span>类目</span><select name="typeid" class="typename">
    <?PHP
      include('class/GoodsType.php');
      $tid=$obj->TypeId;
      $objType = new GoodsType();
      $objType->GetGoodsTypeInfo($tid);
    ?>
    <option value="<?php echo $tid ?>"><?php echo $objType->typeName; ?></option>
    <?php
      $results = $objType->GetGoodsTypelist();
      while($row = $results->fetch_row())
      {
    ?><option value="<?PHP   echo($row[0]); ?>"><?PHP   echo($row[1]); ?></option>  
      <?PHP   } ?>  
    </select></p>
    <p><span>新旧程度</span><input type="text" name="oldnew" class="in" value="<?php echo $obj->OldNew; ?>" placeholder="请填写1-10之间的数字" />
    </p>
    <p><span>价格</span><input type="text" name="gprice" value="<?php echo $obj->Price; ?>" class="in" /></p>
    <p><span>宝贝图片</span><input type="text" name="url" id="url" class="in" readonly="readonly" value="<?php echo $obj->ImageURL; ?>" /><a href="javascript:;" id="upload">上传</a></p>
    <p style="height:160px;"><span>宝贝描述</span><textarea name="gdetail" placeholder="至少15个字" ><?php echo $obj->GoodsDetail; ?></textarea></p>
    <p id="TradePlace"><span>交易地点</span><select name="tradeplace" class="tradeplace">
    <option value="<?php echo $obj->TradePlace; ?>"><?php echo $obj->TradePlace; ?></option>
    <option value="中苑">中苑</option>
    <option value="西苑">西苑</option>
    <option value="东苑">东苑</option>
    <option value="北苑">北苑</option>
    <option value="教学区域">教学区域</option>
    </select>
    </p>
    </div>

    <div class="user-cont">
    <?php 
    	$uname=$obj->OwnerId;
    	$objUser->GetUsersInfo($uname);
    ?>
    联系方式：
    <hr>
      <p><span>姓</span><input type="text" name="gname" value="<?php echo $objUser->RealName; ?>" class="in" /></p>
      <p><span>手机</span><input type="text" name="gtel" value="<?php echo $objUser->Phone; ?>" class="in" /></p>
    </div>
    
    <input type="submit" name="sub" class="submit" value="立即发布" />
    </form>
  </div>
</div>

<script type="text/javascript">
  function validate_required(field,alerttxt){
    with(field){
      if (value==null||value=="") {
        alert(alerttxt);
        return false;
      }else{return true}
    }
  }

  function validate_oldnew(field,alerttxt){
    var reg=/^[1-9]$/;
    with(field){   
       if(!reg.test(field.value)){
        alert(alerttxt);
        return false;
      }else{
        return true;
     }
   }
  }

  function validate_form(thisform){
    with(thisform){
      if(validate_required(gtitle,"标题不能为空")==false){
        gtitle.focus();
        return false;
      }
      if(validate_required(oldnew,"新旧不能为空")==false){
        gtitle.focus();
        return false;
      }else{     
        if(validate_oldnew(oldnew,"新旧程度只能输入0-10之间的数字")==false){
          oldnew.focus();
          return false;
        }
      }
      
      if(validate_required(gprice,"价格不能为空")==false){
        gtitle.focus();
        return false;
      }
      if(validate_required(url,"图片不能为空")==false){
        gtitle.focus();
        return false;
      }
      if(validate_required(gdetail,"商品描述不能为空")==false){
        gtitle.focus();
        return false;
      }
      if(validate_required(gname,"姓不能为空")==false){
        gtitle.focus();
        return false;
      }
      if(validate_required(gtel,"联系电话不能为空")==false){
        gtitle.focus();
        return false;
      }
    }
  }

</script>

<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>