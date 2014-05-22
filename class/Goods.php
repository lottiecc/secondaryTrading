<?php
//本类用于保存对st_goods表的数据库访问
//表的每个字段对应类的每个成员变量
class Goods{
	public $GoodsId;
	public $TypeId;
	public $SaleOrBuy;
	public $GoodsName;
	public $GoodsDetail;
	public $ImageURL;
	public $Price;
	public $StartTime;
	public $OldNew;
	public $PayMode;
	public $DeliverMode;
	public $IsOver;
	public $OwerId;
	var $conn;

	function __construct(){
		//连接数据库
		$this->conn=mysqli_connect("localhost","root","skyline","secondarytrading");
		mysqli_query($this->conn,"SET NAMES utf8");
	}
	
	function __destruct(){
		//关闭数据库
		mysqli_close($this->conn);
	}
	
	
	
	//获取商品信息
	function GetGoodsInfo($Id){
		//设置查询的select语句
		$sql="SELECT * FROM st_goods WHERE goodsId=".$Id;
		//打开记录集
		$results=$this->conn->query($sql);
		//读取商品信息
		if($row=$results->fetch_row()){			
			$this->GoodsId=$Id;
			$this->TypeId=$row[1];
			$this->SaleOrBuy=$row[2];
			$this->GoodsName=$row[3];
			$this->GoodsDetail=$row[4];
			$this->ImageURL=$row[5];
			$this->Price=$row[6];
			$this->StartTime=$row[7];
			$this->OldNew=$row[8];
			$this->PayMode=$row[9];
			$this->DeliverMode=$row[10];
			$this->IsOver=$row[11];
			$this->OwerId=$row[12];
		}else{
			$GoodsId=0;
		}
	}
	
	//根据查询条件获取商品所有信息，返回结果集
	function GetGoodsList($cond){
		//设置查询的select语句
		$sql="SELECT * FROM st_goods".$cond." ORDER BY StartTime DESC";
		//打开记录集
		$results=$this->conn->query($sql);
		return $results;
	}
	
	
	//判断商品分类是否存在
	function HaveGoodsType($tid){
		//设置查询的SELECT语句
		$sql='SELECT * FROM st_goods WHERE typeId='.$tid;
		//打开记录集
		$results=$this->conn->query($sql);
		if($rows=$results->fetch_row()){
			$exist=true;
		}else{
			$exist=false;
		}
		return $exist;
	}
	
	
	//添加信息
	function insert(){
		$sql="INSERT INTO st_goods(
								  typeId,
								  saleorbuy,
								  goodsName,
								  goodsDetail,
								  imageURL,
								  price,
								  startTime,
								  OldNew,
								  PayMode,
								  DeliverMode,
								  isOver,
								  owerId 
								  )
							VALUES(
								  '".$this->TypeId."',
								  '".$this->SaleOrBuy."',
								  '".$this->GoodsName."',
								  '".$this->GoodsDetail."',
								  '".$this->ImageURL."',
								  '".$this->Price."',
								  '".$this->StartTime."',
								  '".$this->OldNew."',
								  '".$this->PayMode."',
								  '".$this->DeliverMode."',
								  '".$this->IsOver."',
								  '".$this->OwerId."'								   
								  )";
		//执行sql语句
		$this->conn->query($sql);
	}
	


  function SetOver($id)  {
    $sql = "UPDATE st_goods SET isOver=1 WHERE goodsId=" . $id;
	$this->conn->query($sql);
  }
	
	
	//批量删除信息
	function delete($id){
		$sql="DELETE FROM st_goods WHERE goodsId IN(".$id.")";
		$this->conn->query($sql);
	}
}
?>
		
		
	