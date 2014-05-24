<?php
session_start();
if(!isset($_COOKIE["username"]) || !isset($_COOKIE["UserType"]) || $_COOKIE["UserType"]!=1){
	header('location:login.php');
	return;
}
?>

<?php
require_once 'medoo.php';
$database = new medoo('secondarytrading');
if(isset($_GET['oper'])){
	$oper = $_GET['oper'];
	if($oper == "delete" && isset($_GET['id'])){
		$database->delete("st_goodstype",[
			"AND" => [
				"typeId" => $_GET['id']
			]
		]);
	} else if ($oper == "update" && isset($_GET['id']) && isset($_GET['name'])) {
		$database->update("st_goodstype",["typeName" => $_GET['name']],["typeId" => $_GET['id']]);
	} else if ($oper == "add" && isset($_GET['name'])) {
		$database->insert("st_goodstype",[
			"typeName" => $_GET['name']
		]);
	}
	
}
header('location:typeController.php');
?>
