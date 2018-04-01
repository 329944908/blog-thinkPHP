<?php
	namespace Api\Model;
	use Api\Model\BaseModel;
	class BlogModel extends BaseModel{
		public function format1($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['title'] = $info['title'];
			$data['classify_id'] = $info['classify_id'];
			$data['date'] = $info['createtime'];
			$data['read_num'] = 101;
			return $data;
		}
		public function format2($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['title'] = $info['title'];
			$data['content'] = $info['content'];
			$data['date'] = $info['createtime'];
			$data['read_num'] = 101;
			//$data['user_img'] = $info['user_img'];
			// $data['user_name'] = $info['user_id'];
			return $data;
		}
		public function format3($info){
			$data = array();
			$data['id'] = $info['id'];
			$data['title'] = $info['title'];
			$data['date'] = $info['createtime'];
			$data['read_num'] = 101;
			//$data['user_id'] = $info['user_id'];
			// $data['user_name'] = $info['user_id'];
			return $data;
		}


	}