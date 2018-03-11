<?php
namespace Home\Controller;
use Think\Controller;
	class HomeController extends Controller {
		public function getBlogInfo(){
			$id = $_GET['id'];
			$blogModel = new \Home\Model\BlogModel();
			$classifyModel = new \Home\Model\ClassifyModel();
			$commentModel = new \Home\Model\CommentModel();
			$userModel = new \Home\Model\UserModel();
			$blogInfo = $blogModel->getInfoById($id);
			$where = "classify_id = {$blogInfo['classify_id']}";
			$brotherBlog = $blogModel ->getLists(0,20,'id asc',$where);
			$blogInfo['createtime'] = substr($blogInfo['createtime'], 0,10);
			$where = "classify_id = {$blogInfo['classify_id']} and id != {$id}";
			$relation = $blogModel->getLists(0, 10,'id asc',$where);
			$comment = $commentModel->getComments($blogInfo['id']); 
			$count = $commentModel->count($blogInfo['id']);
			$praise = new \Home\Model\ZanModel();
			$user_id = isset($_SESSION['me']['id'])?$_SESSION['me']['id']:0;
			foreach ($comment as $key => $value) {
				$comment[$key]['praiseStatus'] = $praise->checkLikeStatus ($user_id,$value['id']);
				$comment[$key]['commenter'] = $userModel-> getUserInfoById($value['user_id']);
				$comment[$key]['createdate'] = date('Y年m月d日 H时i分', strtotime($value['createtime']));
			}
			$this->assign('blogInfo',$blogInfo);
			$this->assign('comment',$comment);
			$this->assign('count',$count);
			$this->assign('brotherBlog',$brotherBlog);
			$this->assign('relation',$relation);
			$this->display();
		}
		public function study(){
			$classify_id = isset($_GET['classify_id']) ? $_GET['classify_id'] : 0;
			$where = '1';
			if ($classify_id) {
				$where .= " and classify_id in ({$classify_id})";
			} else {
				$where .= " and classify_id in (3,4,9,10)";
			}
			$where .= " and status = 1";
			
			$classifyModel = new \Home\Model\ClassifyModel();
			$blogModel = new \Home\Model\BlogModel();
			
			$daohang2 = $classifyModel->getParentLists(2);
			$data = $blogModel->getLists(0,20,'id desc',$where);
			foreach ($data as $key => $value) {
				$data[$key]['year'] = substr($value['createtime'], 0,4);
				$data[$key]['month'] = substr($value['createtime'], 5,5);
				$data[$key]['classify'] = $classifyModel ->getClassifyByID($value['classify_id']);
				$data[$key]['classify_name'] = $data[$key]['classify']['name'];
			}
			$this->assign('daohang2',$daohang2);
			$this->assign('data',$data);
			$this->display();
		}
		public function comment(){
			$data = array();
			$data['user_id'] = $_SESSION['me']['id'];
			$data['blog_id'] = $_POST['blog_id'];
			$data['parent_id'] = 0;
			$data['content']=$_POST['content'];
			$res = checkstr($data['content']);
			$commentModel = new \Home\Model\CommentModel();
			if (!$res) {
				$status = $commentModel->add($data);
				if($status){
					$this->success('评论成功','/Home/Home/getBlogInfo/id/'.$data['blog_id'],3);
				}else{
					$this->error('评论失败');
				}
			} else {
				$this->error('包含敏感字符');
			}
		}
		public function back(){
		  echo "<script>alert('随便写点什么');history.go(-2);</script>";  
		}
		// public function checkStatus(){
		// 	$user_id = $_SESSION['me']['id'];
		// 	$comment_id =$_GET['comment_id'];
		// 	$praise = new \Home\Model\ZanModel();
		// 	$data = $praise->checkLikeStatus ($user_id,$comment_id);
		// } 
		public function praise(){
			$data = array();
			$data['user_id'] = $_SESSION['me']['id'];
			$data['comment_id']=$_GET['comment_id'];
			$data['blog_id'] = $_GET['blog_id'];
			$praise = new \Home\Model\ZanModel();
			$res = $praise->add($data);
			if($res){
				$this->success('赞成功','/Home/Home/getBlogInfo/id/'.$data['blog_id'],3);
			}
		}
		public function disPraise(){
			$user_id = $_SESSION['me']['id'];
			$comment_id =$_GET['comment_id'];
			$blog_id = $_GET['blog_id'];
			$praise = new \Home\Model\ZanModel();
			$res = $praise->del($user_id,$comment_id);
			if($res){
				$this->success('取消赞','/Home/Home/getBlogInfo/id/'.$blog_id,3);
			}
		}
	}