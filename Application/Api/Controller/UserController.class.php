<?php
namespace Api\Controller;
use Think\Controller;
    class UserController extends Controller {
		public function doReg(){
			$data = array();
			$data['name'] = $_POST['uname'];
			$data['phone'] = $_POST['phone'];
			$data['password'] = $_POST['password'];
			if(isset($data['name'])&&!empty($data['name'])&&isset($data['phone'])&&!empty($data['phone'])&&isset($data['password'])&&!empty($data['password'])){
				$userModel =  D('user');
				$status = $userModel->add($data);
				if ($status){
     				_res();
				}else{
    				_res('注册失败',false,'1007');
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function doLogin(){
			$phone = $_POST['phone'];
			$password = $_POST['password'];
			if(isset($phone)&&!empty($phone)){
				$userModel =  D('user');
				$userInfo = $userModel->getUserInfoByPhone($phone);
				if($userInfo){
					if($password == $userInfo['password']){
						$userInfo = $userModel->format1($userInfo);
						$result = array(
						"user"=>$userInfo,
    					);
    					_res($result);
					}else{
						_res('密码错误',false,'1005');
					}
				}else{
					_res('用户不存在',false,'1006');
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function checkEmail(){
			$email = '329944908@qq.com';
			$p = "/(\w+)@(?:qq|163)\.(?:com|cn)/";
			$res = preg_match($p, $email,$arr);
			var_dump($res);
			var_dump($arr);
			die();
		}
	}