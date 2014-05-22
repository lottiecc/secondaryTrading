<?php
session_start();
if($_SESSION["UserType"]!=1){
	header('location:login.php');
}
?>