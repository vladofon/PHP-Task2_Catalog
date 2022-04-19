<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/db/DataSource.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/service/GoodsService.php');

$dataSource = new DataSource;
$connection = $dataSource->getConnection();

$goodsService = new GoodsService($connection);

$goodsItem = new Goods(
	$_POST['id'],
	$_POST['name'],
	$_POST['description'],
	$_POST['price'],
	$_POST['count'],
	$_POST['cover']
);

$goodsService->save($goodsItem);

header('Location: '.'http://task2catalog.com/page/GoodsItem.php?id='.$_POST['id']);