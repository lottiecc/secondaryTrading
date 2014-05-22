<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>二手交易平台</title>
<link rel="stylesheet" type="text/css" href="styles/basic.css" />
<link rel="stylesheet" type="text/css" href="styles/index.css" />
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="js/Search.js"></script>
<script>
window.onload=function(){
	var oCatBd=document.getElementById('catBd');
	var aLi=oCatBd.getElementsByTagName('li');
	var oSepecific=document.getElementById('specific');
	var aDiv=oSepecific.getElementsByTagName('div');
	var oSub=document.getElementById('catCont');
	for(var i=0;i<aLi.length;i++){
		aLi[i].index=i;
		aLi[i].onmouseover=function(){
			oSub.style.display='block';
			for(var i=0;i<aLi.length;i++){
				aDiv[i].style.display='none';
			}
			aDiv[this.index].style.display='block';
		};
	}

    var timeout=[];
    for (var j = 0,length=aDiv.length; j < length; j++) {
        
        (function(index){
            timeout[index]=null;
            aDiv[index].onmouseout=function(){
                timeout[index]=setTimeout(function() {
                    clearTimeout(index);
                    oSub.style.display='none';
                }, 1000);
            };
            aDiv[index].onmouseover=function(){

                clearTimeout(timeout[index]);
            };
        })(j);
        
    };
		
/*	function toDisplay(){
		
		oSub.style.display='block';
	}
	function toHide(){
		var oSub=document.getElementById('sub-category');
		oSub.style.display='none';
	}*/
}
</script>
</head>
<?php
//定义一个常量，用来授权调用includes里的文件
define('IN_ST',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';  //转换成硬路径，引入速度更快
?>
<body>
<div id="wrapper">
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
<div id="bgDes">
    <div id="main">
        <div id="category" class="cat">
            <div class="cat-hd">
            <h2>分类查看</h2>
            </div>
            <div class="cat-bd" id="catBd">
                <ul>
                    <li><a href="list.php?tid=9">图书办公</a></li>
                    <li><a href="list.php?tid=12">宿舍电器</a></li>
                    <li><a href="list.php?tid=10">数码产品</a></li>
                    <li><a href="list.php?tid=13">美妆护肤</a></li>
                    <li><a href="list.php?tid=14">运动户外</a></li>
                    <li><a href="list.php?tid=15">服装饰品</a></li>
                    <li><a href="list.php?tid=16">杂七杂八</a></li>
                </ul>
            </div>
            <div class="cat-cont" id="catCont">
                <ul id="specific" class="sub-concrete">
                    <li>
                        <div data-spm="">
                        <ul>
                            <li>
                                <h4>教辅</h4>
                                <a href="#">本科教材</a>
                                <a href="#">考研</a>
                                <a href="#">四六级</a>
                                <a href="#">雅思</a>
                                <a href="#">托福</a>
                            </li>
                            <li>
                                <h4>文学</h4>
                                <a href="#">中国文学</a>
                                <a href="#">亚洲文学</a>
                                <a href="#">非洲文学</a>
                                <a href="#">欧洲文学</a>
                            </li>
                            <li>
                                <h4>艺术</h4>
                                <a href="#">绘画</a>
                                <a href="#">书法</a>
                                <a href="#">摄影</a>
                                <a href="#">工艺</a>
                                <a href="#">建筑</a>
                                <a href="#">音乐</a>
                                <a href="#">舞蹈</a>
                                <a href="#">电影电视戏曲</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    <li>
                        <div>
                        <ul>
                            <li>电吹风</li>
                            <li>洗衣机</li>
                            <li>烘鞋器</li>
                            <li>蒸蛋器</li>
                            <li>电风扇</li>
                        </ul>
                        </div>
                    </li>
                    <li>
                        <div>
                        <ul>
                            <li>手机</li>
                            <li>电脑</li>
                            <li>相机</li>
                            <li>配件</li>
                            <li>耳机</li>
                            <li>mp3</li>
                        </ul>
                        </div>
                    </li>
                    <li><div></div></li>
                    <li><div></div></li>
                    <li><div></div></li>
                    <li><div></div></li>
                </ul>
            </div>
        </div>
        
    
        <div class="act-news">
            <ul class="acts">
                <li class="act">
                <a href="" title="colors">
                <img src="images/act/colors.jpg" title="colors" alt="colors">
                </a>
                </li>
                <li class="act">
                <a href="" title="cloud">
                <img src="images/act/cloud.jpg" title="cloud" alt="cloud">
                </a>
                </li>
                <li class="act">
                <a href="" title="flower">
                <img src="images/act/flower.jpg" title="flower" alt="flower">
                </a>
                </li>
            </ul>
            <div class="helper">
                <a href="javascript:;" class="prev">
                    <div class="mask-left show"></div>
                </a>
                <a href="javascript:;" class="next">
                    <div class="mask-right show"></div>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="content">
    <div class="cont-nav">
        <ul>
            <li><a href="javascript:;" class="on">最新</a><span>|</span></li>
            <li><a href="javascript:;">价格</a><span>|</span></li>
            <li><a href="javascript:;">价格</a><span>|</span></li>
            <li>
            <div class="cont-search" id="contSearch">
                <form action="search.php">
                <input class="search-input" placeholder="请输入搜索内容..." type="text" value="" autocomplete="off" name="key" id="search">
                <input class="search-submit" type="submit" value="">
                <p class="search-icon" title="搜索所需的物品"><i></i></p>
                </form>
            </div>
            </li>
        </ul>
        <script>new Search( document.getElementById( 'contSearch' ) );</script>
        
		<div class="member-log"><a href="want_to_publish.php">我要发布</a></div>
	</div>
    <div class="cont-list">
        <ul>
        <?php
        include('class/Goods.php');
        $obj=new Goods();
        $cond=" WHERE isOver=0 ";
        $results=$obj->GetGoodsList($cond);
        while($row=$results->fetch_row()){
        ?>
        
        <li><a href="item.php?gid=<?php echo $row[0]; ?>"><img src="upimg/<?php echo $row[5]; ?>" width="240px" height="178px" />
            <p><span><?php echo $row[3]; ?></span></p></a>
        </li>
        
        <?php } ?>
        </ul>
	</div>
    <div class="cont-page">
        <ul>
        <li class="page-top"><a href="#header">top</a></li>
        <li class="page-next"><a href="#">next</a></li>
        </ul>
    </div>
</div>


<?php
require ROOT_PATH.'includes/footer.inc.php';
?>

</div>
</body>
</html>