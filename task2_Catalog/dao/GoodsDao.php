<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/mapper/GoodsMapper.php');

class GoodsDao {
	private $connection;
	private $mapper;

	public function __construct($connection) {
		$this->connection = $connection;
		$this->mapper = new GoodsMapper;
	}

	private $FIND_ALL_DESC = "select * from goods order by id desc";
	private $FIND_ALL_BY_PRICE_DESC = "select * from goods order by price desc";
	private $FIND_ALL_BY_COUNT_DESC = "select * from goods order by count desc";

	private $FIND_ALL_ASC = "select * from goods order by id asc";
	private $FIND_ALL_BY_PRICE_ASC = "select * from goods order by price asc";
	private $FIND_ALL_BY_COUNT_ASC = "select * from goods order by count asc";

	private $FIND_BY_ID = "select * from goods where id = ?";
	private $CREATE = "insert into goods (name, description, price, count, cover) values (?,?,?,?,?)";
	private $UPDATE = 
		"update goods set 
				name = ?, 
				description = ?,
				price = ?,
				count = ?,
				cover = ? where id = ?";
	private $DELETE_BY_ID = "delete from goods where id = ?";

	public function findAllDesc() {
		$stmt = $this->connection->query($this->FIND_ALL_DESC);

		return $this->mapper->mapAll($stmt);
	}

	public function findAllByPriceDesc() {
		$stmt = $this->connection->query($this->FIND_ALL_BY_PRICE_DESC);

		return $this->mapper->mapAll($stmt);
	}

	public function findAllByCountDesc() {
		$stmt = $this->connection->query($this->FIND_ALL_BY_COUNT_DESC);

		return $this->mapper->mapAll($stmt);
	}

	public function findAllAsc() {
		$stmt = $this->connection->query($this->FIND_ALL_ASC);

		return $this->mapper->mapAll($stmt);
	}

	public function findAllByPriceAsc() {
		$stmt = $this->connection->query($this->FIND_ALL_BY_PRICE_ASC);

		return $this->mapper->mapAll($stmt);
	}

	public function findAllByCountAsc() {
		$stmt = $this->connection->query($this->FIND_ALL_BY_COUNT_ASC);

		return $this->mapper->mapAll($stmt);
	}

	public function findById($id) {
		$stmt = $this->connection->prepare($this->FIND_BY_ID);
		$stmt->execute(array($id));

		return $this->mapper->mapAll($stmt)[0];
	}

	public function create($goodsItem) {
		$stmt = $this->connection->prepare($this->CREATE);
		$stmt->execute(array(
			$goodsItem->getName(),
			$goodsItem->getDescription(),
			$goodsItem->getPrice(),
			$goodsItem->getCount(),
			$goodsItem->getCover(),
		));

		$id = $this->connection->lastInsertId();

		return $this->findById($id);
	}

	public function update($goodsItem) {
		$stmt = $this->connection->prepare($this->UPDATE);
		$stmt->execute(array(
			$goodsItem->getName(),
			$goodsItem->getDescription(),
			$goodsItem->getPrice(),
			$goodsItem->getCount(),
			$goodsItem->getCover(),
			$goodsItem->getId()
		));

		return $this->findById($goodsItem->getId());
	}

	public function deleteById($id) {
		$stmt = $this->connection->prepare($this->DELETE_BY_ID);
		$stmt->execute(array($id));
	}

	public function save($goodsItem) {
		if($goodsItem->getId() && $goodsItem->getId() != 0) {
			return $this->update($goodsItem);
		}
			
		return $this->create($goodsItem);
	}

	public function findAll($filter, $direction) {
		if($direction == "desc") {
			if($filter == "price") {
				return $this->findAllByPriceDesc();
			}
			else if($filter == "count") {
				return $this->findAllByCountDesc();
			}

			return $this->findAllDesc();
		}
		else if($direction == "asc") {
			if($filter == "price") {
				return $this->findAllByPriceAsc();
			}
			else if($filter == "count") {
				return $this->findAllByCountAsc();
			}

			return $this->findAllAsc();
		}
	}
}