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
					if($status['status']==1){
						$res1 = $collectModel->where(array('user_id'=>$user_id,'blog_id'=>$blog_id))->setField('status',0);
						if($res1){
							_res('已收藏',false,'1');
						}
					}else{
						$res2 = $collectModel->where(array('user_id'=>$user_id,'blog_id'=>$blog_id))->setField('status',1);
						if($res2){
							_res();
						}
					}
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function lists(){
			$user_id = $_POST['user_id'];
			if(isset($user_id)&&!empty($user_id)){
				$collectModel = D('collect');
				$collect_data  = $collectModel->where(array('user_id'=>$user_id,'status'=>1))->select();
				$collect_blog_arr = array();
				if($collect_data){
					$BlogModel = D('blog');
					$UserModel = D('user');
					$ClassifyModel = D('classify');
					foreach ($collect_data as $key => $value) {
						$collect_blog_arr[] = $value['blog_id']; 
					}
					$map['id']  = array('in',$collect_blog_arr);
					$blog_data = $BlogModel->where($map)->select();
					foreach ($blog_data as $key => $value) {
						$user = $UserModel->where("id = {$value['user_id']}")->find();
						$classify = $ClassifyModel->where("id = {$value['classify_id']}")->find();
						$blog_data[$key] = $BlogModel->format1($value);
						$blog_data[$key]['author_name'] = $user['name'];
						$blog_data[$key]['classify_name'] = $classify['name'];
					}
					$result = array(
    					"blog_lists"=>$blog_data,
			    		);
			    	_res($result);
				}else{
					_res('暂无数据',false,'1009');
				}	
			}
		}
	}