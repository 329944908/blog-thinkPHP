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
	}