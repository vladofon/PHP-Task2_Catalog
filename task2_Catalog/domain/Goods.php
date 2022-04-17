<?php
include_once('Entity.php');

class Goods extends Entity{
	private $name;
	private $description;

	private $price;
	private $count;

	public function __construct($id, $name, $description, $price, $count) {
		parent::__construct($id);
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->count = $count;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName($name) {
		return $this->name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setCount($count) {
		$this->count = $count;
	}

	public function getCount() {
		return $this->count;
	}

	public function toString() {
		return "
			id: $this->id, <br/>
			name: $this->name, <br/>
			description: $this->description, <br/>
			price: $this->price, <br/>
			count: $this->count
		";
	}
 }