<?php

include_once('domain/Goods.php');

class GoodsMapper {
	private $ID = "id";
	private $NAME = "name";
	private $DESCRIPTION = "description";
	private $PRICE = "price";
	private $COUNT = "count";

	public function mapAll($statement) {
		$catalogList = array();

		foreach ($statement as $row)
		{
			$catalogList[] = new Goods(
				$row[$this->ID], 
				$row[$this->NAME], 
				$row[$this->DESCRIPTION], 
				$row[$this->PRICE], 
				$row[$this->COUNT]
			);
		}

		return $catalogList;
	}
}