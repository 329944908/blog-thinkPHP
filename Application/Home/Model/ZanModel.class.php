<?php
	namespace Home\Model;
	class ZanModel extends BaseModel{
		public function add($data){
			$Zan= M("Zan");
			$res=$Zan->add($data);
			return $res;
		}

		public function del($user_id,$comment_id) {
			$Zan = M("Zan");
			$res = $Zan->where("user_id = {$user_id} and comment_id={$comment_id}")->delete();
			return $res;
		}
		public function checkLikeStatus ($user_id,$comment_id) {
			$Zan = M("Zan");
			$data = $Zan ->where("user_id = {$user_id} and comment_id={$comment_id}")->find();
			return isset($data)? $data['status'] : array();
		}
	}