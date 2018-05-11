<?php
	namespace Admin\Controller;
	use Think\Controller;
	class BlogController extends Controller {
		public function add(){
			$Classify = new \Home\Model\ClassifyModel();
			$classify = $Classify->getAllClassify();
			$this->assign('classify',$classify);
			$this->display();
		}
		public function doAdd(){
			$image = uploadFile('image','blog');
			$content = $_POST['content'];
			$classify_id = $_POST['classify_id'];
			$title = $_POST['title'];
			$data = array(
				'title' 	=> $title,
				'content' 	=> $content,
				'image' 	=> $image,
				'classify_id' 	=> $classify_id,			
				);
			$blogModel = new \Home\Model\BlogModel();
			$status = $blogModel->add($data);
			if ($status) {
				$this->success('成功',U('/Admin/Blog/blogLists'));
			}	
		}
		public function blogLists(){
			$p = isset($_GET['p'])?$_GET['p']:1;
			$blogmodel = D("Blog");
			$usermodel = D("User");
			$classify  = D("Classify"); 
			$pageSize = 10;
			$offset = ($p - 1) * $pageSize;
			$count = $blogmodel->count();
			$allPage = ceil($count/$pageSize);
			$data = $blogmodel->getLists($offset,$pageSize);
			foreach ($data as $key => $value){
				$classify_info = $classify->getInfoById($value['classify_id']);
		    	$data[$key]['classify_name'] = $classify_info['name'];
		    }
		    $this->assign('allPage',$allPage);
		    $this->assign('data',$data);
			$this->display('Blog/lists');
		}
		public function line(){
			$id = isset($_GET['id'])?$_GET['id']:0;
			$blogmodel = D("Blog");
			$data = $blogmodel ->getInfoById($id);
			if($data['status'] == '1'){
				$blogmodel->outline($id);
				$this->success('成功',U('/Admin/Blog/blogLists'));
			}else{
				$blogmodel->online($id);
				$this->success('成功',U('/Admin/Blog/blogLists'));
			}
		}
		public function edit(){
			$id = isset($_GET['id'])?$_GET['id']:0;
			$Classify = new \Home\Model\ClassifyModel();
			$blogmodel = D("Blog");
			$data = $blogmodel ->getInfoById($id);
			$classify = $Classify->getAllClassify();
			$this->assign('classify',$classify);
			$this->assign('data',$data);
			$this->display();
		}
		public function doEdit(){
			$id = isset($_POST['id'])?$_POST['id']:0;
			$image2 = $_POST['imagePath'];
			$image = uploadFile('image','blog');
			if(empty($image)){
				$image = $image2;
			}
			$content = $_POST['content'];
			$classify_id = $_POST['classify_id'];
			$title = $_POST['title'];
			$data = array(
				'title' 	=> $title,
				'content' 	=> $content,
				'image' 	=> $image,
				'classify_id' 	=> $classify_id,			
				);
			$blogModel = D("Blog");
			$status = $blogModel->update($id,$data);
			if ($status) {
				$this->success('成功',U('/Admin/Blog/blogLists'));
			}
		}
		public function blogInfo(){
			$id = $id = isset($_GET['id'])?$_GET['id']:0;
			$blogmodel = D('Blog');
			$info = $blogmodel->getInfoById($id);
			$this->assign('info',$info);
			$this->display();
		}
	}