<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/db/DataSource.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/service/GoodsService.php');

$dataSource = new DataSource;
$connection = $dataSource->getConnection();

$goodsService = new GoodsService($connection);

$goodsItem = new Goods(
	0,
	$_POST['name'],
	$_POST['description'],
	$_POST['price'],
	$_POST['count'],
	$_POST['cover']
);

$id = $goodsService->save($goodsItem)->getId();

header('Location: '.'http://task2catalog.com/page/GoodsItem.php?id='.$id);

