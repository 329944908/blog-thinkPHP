<?php
	function uploadFile($name,$path){
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
	    $upload->savePath  =     $path.'/'; // 设置附件上传（子）目录
	    // 上传文件 
	    $info   =   $upload->upload();
	    return $info[$name]['savepath'].$info[$name]['savename'];
	}
	function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
	}
	function checkstr($str){ 
		$needle = "黄";
		$tmparray = explode($needle,$str); 
		if(count($tmparray)>1){ 
			return true; 
		} else{ 
			return false; 
		} 
	} 