<?php
function _alert_back($_info){
	echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
	exit();
}

function _sha1_uniqid(){
	return _mysql_string(sha1(uniqid(rand(),true)));
}
	
function _mysql_string($_string) {
	//get_magic_quotes_gpc()如果开启状态，那么就不需要转义
	if (!GPC) {
		return mysql_real_escape_string($_string);
	} 
	return $_string;
}


function _location($_info,$_url){
	echo "<script type='text/javascript'>alert('".$_info."');location.href='$_url';</script>";
	exit();
}	

/**
*_login_state登录状态的判断
*/
function _login_state(){
	if(isset($_COOKIE['username'])){
		header('Location:index.php');
	}
}


function _session_destroy(){
	session_destroy();
}

function _unsetcookies(){
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	_session_destroy();
	header('Location:index.php');
}

function _check_code($_first_code,$_end_code){
	if($_first_code!=$_end_code){
		_alert_back('验证码错误！');
	}
}


/**
*_code()是验证函数
*@access public 表示函数对外公开
*@param int $_width表示验证码的长度
*@param int $_height表示验证码的高度
*@param int $_rnd_num表示验证码的位数
*@param bool $_flag表示验证码是否需要边框
*@return void 这个函数执行后产生一个验证码
*/
function _code($_width=75,$_height=25,$_rnd_num=4,$_flag=false){
	//创建随机码
	for($i=0;$i<$_rnd_num;$i++){
	$_nmsg.=dechex(mt_rand(0,15));
	}
	//保存在session中
	$_SESSION['code']=$_nmsg;
	
	//创建一张图像
	$_img=imagecreatetruecolor($_width,$_height);
	
	//白色
	$_white=imagecolorallocate($_img,255,255,255);
	
	//填充
	imagefill($_img,0,0,$_white);
	
	if($_flag){
		//黑色,边框
		$_black=imagecolorallocate($_img,0,0,0);
		imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
	}
	
	//随机画出六个线条
	for($i=0;$i<6;$i++){
		$_rnd_color=imagecolorallocate($_img,mt_rand(10,255),mt_rand(10,255),mt_rand(10,255));
		imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
	}
	
	//随机雪花
	for($i=0;$i<50;$i++){
		$_rnd_color=imagecolorallocate($_img,mt_rand(150,255),mt_rand(150,255),mt_rand(150,255));
		imagestring($_img,1,mt_rand(1,$_width-10),mt_rand(1,$_height-10),'*',$_rnd_color);
	}
	
	//输出验证码
	for($i=0;$i<strlen($_SESSION['code']);$i++){
		imagestring($_img,5,$i*$_width/$_rnd_num+mt_rand(1,6),mt_rand(1,($_height-6)/2),$_SESSION['code'][$i],$_black);
	}
		
	
	
	//解决图像无法输出的代码
	ob_clean();
	//输出图像
	header('Content-Type:image/png');
	imagepng($_img);
	
	//销毁
	imagedestory($_img);
}
?>