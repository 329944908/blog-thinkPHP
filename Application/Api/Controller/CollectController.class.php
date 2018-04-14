<?php
	namespace Api\Controller;
	use Think\Controller;
	class CollectController extends Controller {
		public function add(){
			$collectModel = D('collect');
			$userModel = D('user');
			$user_id = $_POST['user_id'];
			$blog_id = $_POST['blog_id'];
			if(isset($user_id)&&!empty($user_id)&&isset($blog_id)&&!empty($blog_id)){
				$status  = $collectModel->where(array('user_id'=>$user_id,'blog_id'=>$blog_id))->find();
				if(!$status){
					$data['user_id'] = $user_id;
					$data['blog_id'] = $blog_id; 
					$data['createtime'] = date("Y-m-d H:i:s");
					$res = $collectModel->add($data);
					if($res){
						_res();
					}else{
						_res('收藏失败',false,'1008');
					}
				}else{
					_res('已收藏',false,'1008');
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
	}