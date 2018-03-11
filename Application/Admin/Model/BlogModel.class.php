<?php
	namespace Admin\Model;
	class BlogModel extends BaseModel{
		public function count(){
			$Blog= M("Blog");
			$count = $Blog->where("status =1")->count();
			return isset($count) ? $count : 0;
		}
		public function online($id){
			$Blog= M("Blog");
			$Blog->status = 1;
			$Blog->where("id = {$id}")->save(); // 根据条件更新记录
		}
		public function outline($id){
			$Blog= M("Blog");
			$Blog->status = 0;
			$Blog->where("id = {$id}")->save();
		}
		public function update($id,$data){
			$Blog= M("Blog");
			$data['updatetime'] = date('Y-m-d H:i:s');
			$data1['title'] = $data['title'];
			$data1['content'] = $data['content'];
			$data1['image'] = $data['image'];
			$data1['classify_id'] = $data['classify_id'];
			$data1['updatetime'] = $data['updatetime'];
			$res = $Blog->where("id = {$id}")->save($data1); // 根据条件更新记录
			return $res;
		}
	}