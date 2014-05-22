<?php
//此类用于保存对表GoodsType的数据库访问操作
class GoodsType{
	public $typeId;
	public $typeName;
	var $conn;
	
	//建立数据连接
	function __construct(){
		$this->conn=mysqli_connect('localhost','root','skyline','secondaryTrading');
		mysqli_query($this->conn,'SET NAMES UTF8');
	}
	
	//关闭连接
	function __destruct(){
		mysqli_close($this->conn);
	}
	
	//获取分类信息
	function GetGoodsTypeInfo($id){
		//设置查询的SELECT语句
		$sql='SELECT * FROM st_goodstype WHERE typeId='.$id;
		//打开记录集
		$results=$this->conn->query($sql);
		//读取分类数据
		if($rows=$results->fetch_row()){
			$this->typeId=$id;
			$this->typeName=$rows[1];
		}else{
			$typeId='';
		}
	}
	
	//获取所有分类信息，返回结果集
	function GetGoodsTypeList(){
		//设置查询的SELECT语句
		$sql='SELECT * FROM st_goodstype';
		//打开记录集
		$results=$this->conn->query($sql);
		return $results;
	}
	
	//判断指定商品是否存在
	function HaveGoodsType($name){
		//设置查询的SELECT语句
		$sql='SELECT * FROM st_goodstype WHERE typeName=".$name."';
		//打开记录集
		$results=$this->conn->query($sql);
		if($rows=$results->fetch_row()){
			$exist=true;
		}else{
			$exist=false;
		}
		return $exist;
	}
	
	//添加分类信息
	function insert(){
		$sql="INSERT INTO st_goodstype(
									   typeName
									   )
							   VALUES(
									   '".$this->typeName."'
									   )";
		//执行SQL语句
		$results=$this->conn->query($sql);
	}
	
	
	//修改分类信息
	function update($id){
		$sql='UPDATE typeName FROM st_goodstype WHERE typeId='.$id;
		//执行SQL语句
		$results=$this->conn->query($sql);
	}
	
	//删除分类信息
	function delete($id){
		$sql='DELETE FROM st_goodstype WHERE typeId IN ('.$id.')';
		//执行SQL语句
		$results=$this->conn->query($sql);
	}	
}

?>