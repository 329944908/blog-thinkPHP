<?php
	namespace Admin\Model;
	class UserModel extends BaseModel{
		public function getUserLists(){
			$data = $this->select();
			return $data;
		}
		public function online($id){
			$User= M("User");
			$User->status = 1;
			$User->where("id = {$id}")->save(); // 根据条件更新记录
		}
		public function outline($id){
			$User= M("User");
			$User->status = 0;
			$User->where("id = {$id}")->save();
		}
	}