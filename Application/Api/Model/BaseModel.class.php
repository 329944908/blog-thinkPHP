<?php
	namespace Api\Model;
	use Think\Model;
	class BaseModel extends Model{
		public function getInfoById($id){
			$info = $this->where("id= {$id}")->find();
			return $info;
		}
		public function getLists($offset=0,$pageSize=20,$order ='id asc',$where='1'){
			$data = $this->where("status=1 and {$where}")->order("{$order}")->limit($offset,$pageSize)->select();
			return $data;
		}
		public function add($data){
			$data['createtime'] = date("Y-m-d H:i:s");
			$res = parent::add($data);
			return $res;
		} 
		// public function getInfoById($id){
		// 	$sql = "select * from {$this->table} where id = {$id}";
		// 	$res = $this->mysqli->query($sql);
		// 	$Info = $res->fetch_all(MYSQLI_ASSOC);
		// 	return isset($Info[0]) ? $Info[0] : array();
		// }
		// public function add($data){
		// 	$data['createtime'] = date("Y-m-d H:i:s");
		// 	$sql = "insert into {$this->table}";
		// 	$keys = "(";
		// 	$values = "(";
		// 	foreach ($data as $key => $value) {
		// 		if (!in_array($key, $this->field)) {
		// 			continue;
		// 		}
		// 		$keys .= $key .",";
		// 		if (is_string($value)) {
		// 			$value = "'".$value."'";
		// 		}
		// 		$values .= $value . ",";
		// 		}
		// 		$keys = rtrim($keys, ',') . ")";
		// 		$values = rtrim($values, ',') . ")";

		// 		$sql = "{$sql} {$keys} value {$values}";
		// 		var_dump($sql);die();
		// 		$res = $this->mysqli->query($sql);
		// 		return $res;
			
		// } 
	}