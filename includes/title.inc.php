<?php
//防止恶意调用
if (!defined('IN_ST')) {
	exit('Access Defined!');
}
//防止非HTML页面调用
if (!defined('SCRIPT')) {
	exit('Script Error!');
}
?>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="styles/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/<?php echo SCRIPT?>.css" />
