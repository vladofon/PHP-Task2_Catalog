<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/db/DataSource.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/service/GoodsService.php');

$dataSource = new DataSource;
$connection = $dataSource->getConnection();

$goodsService = new GoodsService($connection);

$goodsService->remove($_POST['id']);

header('Location: '.'http://task2catalog.com/');