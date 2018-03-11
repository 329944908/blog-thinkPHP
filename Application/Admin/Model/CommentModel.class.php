<?php
	namespace Home\Model;
	class CommentModel extends BaseModel{
		public $table="comment";
		function add($data){
			$data['createtime'] = date('Y年m月d日 H时i分');
			$Comment= M("Comment");
			$res=$Comment->add($data);
			return $res;
		}
		function getComments($blog_id){
			$Comment= M("Comment");
			$data = $Comment->where("blog_id ={$blog_id}")->select();
			return $data;
		}
		function count($blog_id){
			$Comment= M("Comment");
			$count = $Comment->where("blog_id ={$blog_id}")->count();
			return isset($count) ? $count : 0;
		}
	}