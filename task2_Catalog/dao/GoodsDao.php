<?php

include_once('domain/Goods.php');
include_once('mapper/GoodsMapper.php');

class GoodsDao {
	private $connection;
	private $mapper;

	public function __construct($connection) {
		$this->connection = $connection;
		$this->mapper = new GoodsMapper;
	}

	private $FIND_ALL = "select * from goods";
	private $FIND_BY_ID = "select * from goods where id = ?";

	public function findAll() {
		$stmt = $this->connection->query($this->FIND_ALL);

		return $this->mapper->mapAll($stmt);
	}

	public function findByID($id) {
		$stmt = $this->connection->prepare($this->FIND_BY_ID);
		$stmt->execute(array($id));

		return $this->mapper->mapAll($stmt);
	}
}