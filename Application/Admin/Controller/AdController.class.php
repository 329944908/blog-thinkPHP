<?php
namespace Admin\Controller;
use Think\Controller;
class AdController extends Controller{
	public $model = 'Ad';
    public function add(){
        $this->display();
    }
    public function doAdd(){
            $image = uploadFile('image','ad');
            $url = $_POST['url'];
            $title = $_POST['title'];
            $data = array(
                'title'     => $title,
                'url'   => $url,
                'img'     => $image,           
                );
            $AdModel = new \Admin\Model\AdModel();
            $status = $AdModel->add($data);
            if ($status) {
                $this->success('成功',U('/Admin/Ad/lists'));
            }   
    }
}