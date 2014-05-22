<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//防止恶意调用
if (!defined('IN_ST')) {
	exit('Access Defined!');
}

function _check_uniqid($_first_uniqid,$_end_uniqid){
	if((strlen($_first_uniqid)!=40)||($_first_uniqid!=$_end_uniqid)){
		_alert_back('唯一标识符异常！');
	}
	return _mysql_string($_first_uniqid);
}
?>