<?php
//本类用于保存对st_user表的数据库访问
//表的每个字段对应于类的每个成员变量
Class Users{
	public $UserId;
	public $Uniqid;
	public $Active;
	public $UserName;
	public $Password;
	public $Email;
	public $Photo;
	public $RealName;
	public $RealNumber;
	public $Phone;
	public $QQ;
	public $UserType;
	var $conn;
	
	function __construct(){
		require_once 'DBConnectionHolder.php';
		$dbConnectionHolder = new DBConnectionHolder();
		$this->conn = $dbConnectionHolder->conn;
	}
	
	function __destruct(){
		mysqli_close($this->conn);
	}
	
	
	//获取个人信息
	function GetUsersInfo($uname){
		$sql="SELECT * FROM st_user WHERE st_username='".$uname."'";
		$results=$this->conn->query($sql);
		if($row=$results->fetch_array()){
			$this->UserId=$row['st_id'];
			$this->Uniqid=$row['st_uniqid'];
			$this->Active=$row['st_active'];
			$this->UserName=$uname;
			$this->Password=$row['st_password'];
			$this->Email=$row['st_email'];
			$this->Photo=$row['st_photo'];
			$this->RealName=$row['st_realname'];
			$this->RealNumber=$row['st_realnumber'];
			$this->Phone=$row['st_phone'];
			$this->QQ=$row['st_qq'];
			$this->UserType=['UserType'];
		}else{
			$this->UserName="";
		};
	}
	
	
	//获取个人信息，返回结果集
	function GetUsersList(){
		$sql="SELECT * FROM st_user ";
		//打开记录集
		$results=$this->conn->query($sql);
		return $results;
	}
	
	//判断指定用户名是否存在
	function HaveUsers($uid){
		$sql="SELECT * FROM st_user WHERE st_id=".$uid;
		$results=$this->conn->query($sql);
		if($row=$results->fetch_row()){
			$exist=true;
		}else{
			$exist=false;
		}
		return $exist;
	}
	
	
	function insert(){
		$sql="INSERT INTO st_user(
			  								  
								  )
		VALUES(

			   )";
		$this->conn->query($sql);
	}

	function update($uid){
		$sql="UPDATE st_user SET st_realname='".$this->RealName."',st_phone='".$this->Phone."',st_qq='".$this->QQ."',st_email='".$this->Email."'  WHERE st_id=" .$uid;
		return $this->conn->query($sql);
	}
	
	function changePassword($uid,$old,$new){
		$sql="UPDATE st_user SET st_password='".$new."'  WHERE st_id=" .$uid." AND st_password='".$old."'";
		return $this->conn->query($sql);
	}
	
	
}
		
		