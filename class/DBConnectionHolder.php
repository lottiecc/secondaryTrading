<?php
	
	Class DBConnectionHolder {
		var $conn;
		
		function __construct(){
			$this->conn=mysqli_connect('localhost','root','skyline','secondarytrading');
			mysqli_query($this->conn,"SET NAMES UTF8");
		}
	}
?>