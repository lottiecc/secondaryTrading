<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';  //转换成硬路径，引入速度更快
//运行验证码函数
//默认验证码大小：75*25，默认位数是4位
//第四个参数：是否要边框。false,不要;true,要。
//可以通过数据库的方法来设置验证码的各种属性
_code();
?>