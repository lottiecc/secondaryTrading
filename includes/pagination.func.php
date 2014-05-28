<?php

$pageNo = 1;
$pageSize = 10;

if( isset($_GET["pageNo"]) && $_GET["pageNo"] > 0 ) {
	$pageNo = $_GET["pageNo"];
}
if( isset($_GET["pageSize"]) && $_GET["pageSize"] > 0) {
	$pageSize = $_GET["pageSize"];
}

$OFFSET = ($pageNo - 1) * $pageSize;

function echoPagination($pageNo,$pageSize,$count,$url="") {
	if($url != ""){
		$url = $url."&";
	}
	$sum = ceil($count/$pageSize);
	if($sum > 1){
		$i = 1;
		for(;$i <= $sum; $i += 1) {
			if($i == $pageNo) echo '<li class="current">'.$i.'</ li>';

			else echo '<li class="notcurrent"><a href="?'.$url.'pageNo='.$i.'&pageSize='.$pageSize.'">'.$i.'</a></ li>';
		}
	}
}
?>