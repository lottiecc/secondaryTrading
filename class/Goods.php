<?php
//本类用于保存对st_goods表的数据库访问
//表的每个字段对应类的每个成员变量
class Goods{
	public $GoodsId;
	public $TypeId;
	public $GoodsName;
	public $GoodsDetail;
	public $ImageURL;
	public $Price;
	public $OldNew;
	public $TradePlace;
	public $StartTime;
	public $IsOver;
	public $OverTime;
	public $OwnerId;
	var $conn;

	function __construct(){
		require_once 'DBConnectionHolder.php';
		$dbConnectionHolder = new DBConnectionHolder();
		$this->conn = $dbConnectionHolder->conn;
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
		if($row=$results->fetch_array()){			
			$this->GoodsId=$Id;
			$this->TypeId=$row['typeId'];
			$this->GoodsName=$row['goodsName'];
			$this->GoodsDetail=$row['goodsDetail'];
			$this->ImageURL=$row['imageURL'];
			$this->Price=$row['price'];
			$this->OldNew=$row['OldNew'];
			$this->TradePlace=$row['tradePlace'];
			$this->StartTime=$row['startTime'];
			$this->IsOver=$row['isOver'];
			$this->OverTime=$row['overTime'];
			$this->OwnerId=$row['ownerId'];
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
	//根据查询条件获取商品所有信息，返回结果集
	function GetGoodsListTwelve($cond){
		//设置查询的select语句
		$sql="SELECT * FROM st_goods".$cond." ORDER BY StartTime DESC LIMIT 12";
		//打开记录集
		$results=$this->conn->query($sql);
		return $results;
	}
	
	function SearchGoods($cond,$offset,$pageSize){
		$sql="SELECT * FROM st_goods ".$cond." ORDER BY StartTime DESC LIMIT ".$offset.",".$pageSize;
		$results=$this->conn->query($sql);
		return $results;
	}
	function CountGoods($cond){
		$sql="SELECT COUNT(*) FROM st_goods ".$cond;
		$count=$this->conn->query($sql);
		return $count->fetch_row()[0];
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
								  goodsName,
								  goodsDetail,
								  imageURL,
								  price,
								  OldNew,
								  tradePlace,
								  startTime,
								  isOver,
								  ownerId 
								  )
							VALUES(
								  '".$this->TypeId."',
								  '".$this->GoodsName."',
								  '".$this->GoodsDetail."',
								  '".$this->ImageURL."',
								  '".$this->Price."',
								  '".$this->OldNew."',
								  '".$this->TradePlace."',
								  '".$this->StartTime."',
								  '".$this->IsOver."',
								  '".$this->OwnerId."'								   
								  )";
		//执行sql语句
		//$this->conn->query($sql);
		mysql_query($sql)or die(mysql_error());
	}


	function update($gid){
		$sql="UPDATE st_goods SET  typeId='".$this->TypeId."',goodsName='".$this->GoodsName."',goodsDetail='".$this->GoodsDetail."',imageURL='".$this->ImageURL."',price='".$this->Price."', OldNew='".$this->OldNew."',tradePlace='".$this->TradePlace."'  WHERE goodsId=" .$gid;
		return $this->conn->query($sql);
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
		
		
	