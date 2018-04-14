<?php
	namespace Api\Controller;
	use Think\Controller;
	class BlogController extends Controller {
		public function info(){
			$id = $_GET['id'];
			if(!preg_match("/^\d+$/", $id)){
				_res('参数错误',false,'1001');
			}
			$blogModel = D('Blog');
			$classifyModel = D('classify');
			$userModel = D('user');
			$blogInfo = $blogModel->getInfoById($id);
			if(!$blogInfo){
				_res('无法找到该记录',false,'1002');
			}
			$where = "classify_id = {$blogInfo['classify_id']}";
			$brotherBlog = $blogModel ->getLists(0,20,'id asc',$where);
			$where = "classify_id = {$blogInfo['classify_id']} and id != {$id}";
			$relation = $blogModel->getLists(0, 10,'id asc',$where);
			$blogInfo = $blogModel->format2($blogInfo);
			foreach ($brotherBlog as $key => $value) {
				$brotherBlog[$key] = $blogModel->format3($value);
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
	}