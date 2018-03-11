<?php
	namespace Home\Model;
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
		public function getUserInfoByEmail($email){
			$User= M("User");
			$userInfo = $User->where("email = '{$email}'")->select();
			// $sql = "select * from user where email = '{$email}'";
			// $res = $this->mysqli->query($sql);
			// $userInfo = $res->fetch_all(MYSQLI_ASSOC);
			return isset($userInfo[0]) ? $userInfo[0]:array();
		}
		// public function getUserInfoById($id){
		// 	return $this->getInfoById($id);
		// }
	}