<?php
	namespace Api\Model;
	class UserModel extends BaseModel{
        public function getUserInfoById($id){
            $User= M("User");
            $info = $User->where("id={$id}")->find();
            return $info;
        }
        // $name,$email,$password,$image,$status=0
		public function addUser($data){
			$User= M("User");
			$data['createtime'] = date("Y-m-d H:i:s");
			$res = $User->add($data);
			// $sql = "insert into user(name,email,password,image,status,createtime) values('{$name}','{$email}','{$password}','{$image}','{$status}','{$createtime}')";
		 // 	$res = $this->mysqli->query($sql);
		}
		public function getUserInfoByPhone($phone){
			$User= M("User");
			$userInfo = $User->where("phone = '{$phone}'")->find();
			return isset($userInfo) ? $userInfo:array();
		}
		public function format1($info){
			$data = array();
			$data['userid'] = $info['id'];
			$data['username'] = $info['name'];
			$data['userimg'] = $info['image'];
			return $data;
		}
	}