<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$Blog = M("Blog");
    	$Classify = M("Classify");
		$data = $Blog->where('status=1')->order('id desc')->limit(0,5)->select();
		foreach ($data as $key => $value) {
				$data[$key]['year'] = substr($value['createtime'], 0,4);
				$data[$key]['month'] = substr($value['createtime'], 5,5);
				$data[$key]['classify'] = $Classify->where("id = {$value['classify_id']}")->find();
				$data[$key]['classify_name'] = $data[$key]['classify']['name'];
		}
		$this->assign('data',$data);
		$this->display('/home/index');
    }
}
