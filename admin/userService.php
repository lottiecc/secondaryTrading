<?php 
include 'components/header.php';
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
