<?php
namespace Api\Model;
use Api\Model\BaseModel;
class AdModel extends BaseModel {
	public function format($info){
		$data = array();
		$data['id'] = $info['id'];
		$data['img'] = C('ImageUrl').$info['img'];
		$data['url'] = $info['url'];
		$data['title'] = $info['title'];
		return $data;
	}
}