<?php
	namespace Api\Controller;
	use Think\Controller;
	class BlogController extends Controller {
		public function info(){
			$id = $_GET['id'];
			$user_id = $_GET['user_id'];
			if(!preg_match("/^\d+$/", $id)){
				_res('参数错误',false,'1001');
			}
			$blogModel = D('Blog');
			$classifyModel = D('classify');
			$userModel = D('user');
			$collectModel = D('collect');
			$blogInfo = $blogModel->getInfoById($id);
			if(!$blogInfo){
				_res('无法找到该记录',false,'1002');
			}
			$where = "classify_id = {$blogInfo['classify_id']} and id != {$id}";
			$relation = $blogModel->getLists(0, 10,'id asc',$where);
			$blogInfo['author_name'] = $userModel->where(array('id'=>$blogInfo['user_id']))->getField('name');
			$blogInfo = $blogModel->format2($blogInfo);
			if(isset($user_id)&&!empty($user_id)){
				$collect_status = $collectModel->where(array('blog_id'=>$id,'user_id'=>$user_id))->find();
				if($collect_status['status']){
					$blogInfo['collect_status'] =  1;
				}else{
					$blogInfo['collect_status'] =  0;	
				}
			}else{
				$blogInfo['collect_status'] =  -1;
			}
			foreach ($relation as $key => $value) {
				$relation[$key] = $blogModel->format3($value);
			}
			$result = array(
			"blog_info"=>$blogInfo,
    		"related_blog"=>$relation,
    		);
    		_res($result);
		}
		public function lists(){
			$classify_id = $_GET['classify_id'];
			if(isset($classify_id)&&!empty($classify_id)){
				$BlogModel = D("Blog");
    			$ClassifyModel = D("Classify");
    			$UserModel = D("User");
				$blog_data = $BlogModel->where(array('status'=>1,'classify_id'=>$classify_id))->select();
				if($blog_data){
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
					_res('暂无数据',false,'1007');
				}
			}else{
				_res('参数错误',false,'1002');
			}
		}
		public function add(){
			$user_id = $_GET['user_id'];
			if(isset($user_id)&&!empty($user_id)){
				$ClassifyModel = D("Classify");
				$classify_data = $ClassifyModel->where('status=1')->select();
				foreach ($classify_data as $key => $value) {
					$classify_data[$key] = $ClassifyModel->format($value);
				}
				$blog_id = $_GET['blog_id'];
				if(isset($blog_id)&&!empty($blog_id)){
					$BlogModel = D("Blog");
					$blogInfo= $BlogModel->where(array('user_id'=>$user_id,'id'=>$blog_id))->find();
					if($blogInfo){
						$my_blog_info['title'] = $blogInfo['title'];
						$my_blog_info['content'] = $blogInfo['content'];
						$my_blog_info['classify_id']= $blogInfo['classify_id'];
						$my_blog_info['createtime']= $blogInfo['createtime'];
						$result = array(
							"classify_lists"=>$classify_data,
				    		"my_blog_info"=>$my_blog_info,
				    	);
			    		_res($result);
					}else{
						_res('暂无数据',false,'1009');
					}
				}else{
					$result = array(
			    		"classify_lists"=>$classify_data,
			    		);
			    	_res($result);
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function doAdd(){
			$data['user_id'] = $_POST['user_id'];
			$data['title'] = $_POST['title'];
			$data['content'] = $_POST['content'];
			$data['classify_id'] = $_POST['classify_id'];
			if(isset($data['user_id'])&&!empty($data['user_id'])&&isset($data['title'])&&!empty($data['title'])&&isset($data['content'])&&!empty($data['content'])&&isset($data['classify_id'])&&!empty($data['classify_id'])){
				$BlogModel = D("Blog");
				$res = $BlogModel->add($data);
				if($res){
					_res();
				}else{
					_res('发布失败',false,'1011');
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function myBlog(){
			$user_id = $_POST['user_id'];
			if(isset($user_id)&&!empty($user_id)){
				$BlogModel = D("Blog");
				$ClassifyModel = D("Classify");
				$blog_data = $BlogModel->where(array('user_id'=>$user_id))->select();
				foreach ($blog_data as $key => $value) {
					$classify = $ClassifyModel->where("id = {$value['classify_id']}")->find();
					$blog_data[$key] = $BlogModel->format1($value);
					$blog_data[$key]['classify_name'] = $classify['name'];
				}
				$result = array(
		    		"my_blog_lists"=>$blog_data,
		    		);
		    	_res($result);
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function del(){
			$user_id = $_POST['user_id'];
			$blog_id = $_POST['blog_id'];
			if(isset($user_id)&&!empty($user_id)&&isset($blog_id)&&!empty($blog_id)){
				$BlogModel = D("Blog");
				$res= $BlogModel->where(array('user_id'=>$user_id,'id'=>$blog_id))->delete();
				if($res){
					_res();
				}else{
					_res('参数错误',false,'1001');
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
		public function doEdit(){
			$user_id = $_POST['user_id'];
			$blog_id = $_POST['blog_id'];
			$data['title'] = $_POST['title'];
			$data['content'] = $_POST['content'];
			$data['classify_id'] = $_POST['classify_id'];
			if(isset($user_id)&&!empty($user_id)&&isset($blog_id)&&!empty($blog_id)&&isset($data['title'])&&!empty($data['title'])&&isset($data['content'])&&!empty($data['content'])&&isset($data['classify_id'])&&!empty($data['classify_id'])){
				$BlogModel = D("Blog");
				$res = $BlogModel->where(array('user_id'=>$user_id,'id'=>$blog_id))->save($data);
				if($res){
					_res();
				}else{
					_res('跟新失败',false,'1011');
				}
			}else{
				_res('参数错误',false,'1001');
			}
		}
	}