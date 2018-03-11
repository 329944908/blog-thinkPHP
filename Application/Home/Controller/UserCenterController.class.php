<?php
namespace Home\Controller;
use Think\Controller;
    class UserCenterController extends Controller {
		public function reg(){
			include "./Application/Home/View/user/reg.html";
		}
		public function doReg(){
			$data = array();
			$data['name'] = $_POST['name'];
			$data['email'] = $_POST['email'];
			$data['image'] = uploadFile('image','user');
			$data['password'] = $_POST['password'];
			$userModel = new \Home\Model\UserModel();
			$status = $userModel->add($data);
			if ($status){
     			$this->success('注册成功','/Home/UserCenter/login',3);
			}else{
    			$this->error('注册失败');
			}
			
		}
		public function login(){
			include "./Application/Home/View/user/login.html";

		}
		public function doLogin(){
			$email = $_POST['email'];
			$password = $_POST['password'];
			$verifyCode = $_POST['verifyCode'];
			$userModel = new \Home\Model\UserModel();
			$userInfo = $userModel->getUserInfoByEmail($email);
			if($userInfo['status']){
				$_SESSION['me'] = $userInfo;
				if($userInfo){
					if($password == $userInfo['password']){
						$res = check_verify($verifyCode, $id = '');
						if($res){
							$this->success('登录成功','/Home/Index/index',3);
						}else{
							$this->error('验证码错误','/Home/UserCenter/login',3);
						}
					}else{
						$this->error('密码错误','/Home/UserCenter/login',3);
					}
				}else{
					$this->error('该用户不存在','/Home/UserCenter/reg',3);
				}
			}else{
				$this->error('该用户已封号');
			}	
		}
		public function logout(){
			unset($_SESSION['me']);
		    echo "<script>history.go(-1);</script>";  
		}
		public function verifyCode(){
			$config =    array(
			    'fontSize'    =>   15,    // 验证码字体大小
			    'length'      =>    4,     // 验证码位数
			    'useNoise'    =>    true, // 关闭验证码杂点
			);
			$Verify = new \Think\Verify($config);
			$Verify->entry();
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