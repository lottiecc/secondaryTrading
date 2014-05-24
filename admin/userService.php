<?php
session_start();
if(!isset($_COOKIE["username"]) || !isset($_COOKIE["UserType"]) || $_COOKIE["UserType"]!=1){
	header('location:login.php');
	return;
}
?>

<?php
if(isset($_GET['st_id'])){
	require_once 'medoo.php';
	$database = new medoo('secondarytrading');
	$database->delete("st_user",[
		"AND" => [
			"st_id" => $_GET['st_id']
		]
	]);
}
header('location:userController.php');
?>
