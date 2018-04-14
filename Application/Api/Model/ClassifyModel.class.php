<?php
	namespace Api\Model;
	class ClassifyModel extends BaseModel{
		// public $mysqli;
		// public $table="classify";
		// public function getLists(){
		// 	$this->getLists($offset,$pageSize,$order,$where);
		// }

		// public function audit($status,$id){
		// 	$sql = "update  classify set status={$status} where id = {$id}";
		// 	$this->mysqli->query($sql);
		// }
		public function getClassifyByID($id){
			$Classify= M("Classify");
			$data = $Classify->where("id= {$id}")->select();
			return isset($data[0]) ? $data[0] :array();
		}
		// public function edit($name,$parent_id,$id){
		// 	$sql = "update  classify set name='{$name}',parent_id={$parent_id} where id = {$id}";
		// 	$this->mysqli->query($sql);

		// }
		public function getParentLists($parent_id = 0){
			$Classify= M("Classify");
			$data = $Classify->where("parent_id= {$parent_id}")->select();
			return $data;
		}
		// public function add($name,$parent_id){
		// 	$sql = "insert into classify(name,parent_id) values('{$name}',$parent_id)";
		// 	$this->mysqli->query($sql);
		// }
		public function getAllClassify($parent_id= 0){
			$Classify= M("Classify");
			$data = $Classify->where("parent_id= {$parent_id}")->select();
			foreach ($data as $key => $value) {
				$child = $Classify->where("parent_id= {$value['id']}")->select();
				$data[$key]['child'] = $child;
			}
			return $data;
		}
		// public function getClassifyId($parent_id){
		// 	$Classify= M("Classify");
		// 	$res = $Classify->where("parent_id= {$parent_id}")->select('classify_id');
		// 	// $sql = "select classify_id from classify where parent_id ={$parent_id}";
		// 	// $res = $this->mysqli->query($sql);
		// }
		public function format($info){
			$data = array();
			$data['classify_id'] = $info['id'];
			$data['classify_name'] = $info['name'];
			return $data;
		}
	}
