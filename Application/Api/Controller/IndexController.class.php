<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$BlogModel = D("Blog");
    	$ClassifyModel = D("Classify");
    	$UserModel = D("User");
    	$AdModel = D("Ad");
    	$ad_data = $AdModel->where('status=1')->select();
		$blog_data = $BlogModel->where('status=1')->select();
		foreach ($blog_data as $key => $value) {
				$user = $UserModel->where("id = {$value['user_id']}")->find();
				$classify = $ClassifyModel->where("id = {$value['classify_id']}")->find();
				$blog_data[$key] = $BlogModel->format1($value);
				$blog_data[$key]['author_name'] = $user['name'];
				$blog_data[$key]['classify_name'] = $classify['name'];
		}
		foreach ($ad_data as $key => $value) {
				$ad_data[$key] = $AdModel->format($value);
		}
		$result = array(
			"banner"=>$ad_data,
    		"blog_lists"=>$blog_data,
    		);
    	_res($result);
		// $this->assign('data',$data);
		// $this->display('/home/index');
    }
}
