<?php
	namespace Admin\Controller;
	use Think\Controller;
	class UserCenterController extends Controller {
		public function userLists(){
			$usermodel = D("User");
			$data = $usermodel->getUserLists();
			$this->assign('data',$data);
			$this->display('user/userLists');
		}
		public function line(){
			$id = isset($_GET['id'])?$_GET['id']:0;
			$usermodel = D("User");
			$data = $usermodel ->getInfoById($id);
			if($data['status'] == '1'){
				$usermodel->outline($id);
				$this->success('成功',U('/Admin//UserCenter/userLists'));
			}else{
				$usermodel->online($id);
				$this->success('成功',U('/Admin//UserCenter/userLists'));
			}
		}
	}