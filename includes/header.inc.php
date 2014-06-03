<?php
header("content-type:text/html; charset=utf-8");
//防止恶意调用
if(!defined('IN_ST')){
	exit('非法调用');
}
?>
<div id="header">	
	<div id="headerContent">
        <h1><a href="index.php" class="logo">南财二手</a></h1>
        <ul>
            <li class="nav-index"><a href="./" class="on">首页</a></li>
            <li class="nav-act"><a href="#footer">关于</a></li>
        </ul>
        <div class="top-nav-info">
            <?php
            if(isset($_COOKIE['username'])){
                echo '<a href="member.php">'.$_COOKIE['username'].'</a>,欢迎回来！';
                echo '<a href="logout.php">退出</a>';
            }else{
				echo '<a href="login.php">登录</a>'; 
				echo "\n";
				echo '<a href="reg.php">注册</a>';    
            }
            ?>	
        </div>	
	</div>
</div>