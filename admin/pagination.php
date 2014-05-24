<?php

$pageNo = 1;
$pageSize = 10;

if( isset($_GET["pageNo"]) ) {
	$pageNo = $_GET["pageNo"];
}
if( isset($_GET["pageSize"]) ) {
	$pageSize = $_GET["pageSize"];
}

$OFFSET = ($pageNo - 1) * $pageSize;

function echoPagination($pageNo,$pageSize,$count) {
	$sum = ceil($count/$pageSize);
	if($sum > 1){
		$i = 1;
		for(;$i <= $sum; $i += 1) {
			echo '<span style="margin:0 10px">';
			if($i == $pageNo) echo $i;
			else echo '<a href="?pageNo='.$i.'&pageSize='.$pageSize.'">'.$i.'</a>';
			echo '</span>';
		}
	}
}
?>