<?php
/**
*_setcookie生成登录cookie
*/
function _setcookie($_username,$_uniqid){
	setcookie('username',$_username);
    setcookie('uniqid',$_uniqid);
}
?>