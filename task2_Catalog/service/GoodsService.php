<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/dao/GoodsDao.php');

class GoodsService {
	private $goodsDao;

	public function __construct($connection) {
		$this->goodsDao = new GoodsDao($connection);
	}

	public function goodsList($filter=null, $direction=null) {
		if(!isset($direction)) {
			$direction = "desc";
		} 

		return $this->goodsDao->findAll($filter, $direction);
	}

	public function getOne($id) {
		return $this->goodsDao->findById($id);
	}

	public function save($goodsItem) {
		return $this->goodsDao->save($goodsItem);
	}

	public function remove($id) {
		return $this->goodsDao->deleteById($id);
	}
}