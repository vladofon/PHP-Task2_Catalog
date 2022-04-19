<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/db/DataSource.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/service/GoodsService.php');

	$dataSource = new DataSource;
	$connection = $dataSource->getConnection();
	$goodsService = new GoodsService($connection);
	$itemId = $_GET['id'];

	$item = $goodsService->getOne($itemId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Document</title>
	<style>body {background-color: #f0f0f0;}</style>
</head>
<body>

	<div class="container-fluid p-0">
		<h1 class="text-center bg-primary bg-gradient text-white py-3">
			<a href="/" class="text-decoration-none text-white">Store Catalog</a>
		</h1>
		<div class="container my-5">
			<div class="row">
				<div class="col-8">
					<div class="card">
						<img src="<?= $item->getCover(); ?>" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title"><?= $item->getName(); ?></h5>
							<p class="card-subtitle mb-2 text-muted"><?= $item->getCount()." available" ?></p>
							<p class="card-text"><?= $item->getDescription(); ?></p>
							<a href="#" class="btn btn-primary">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="card" style="width: 18rem;">
  						<div class="card-body">
    						<h5 class="card-title">Choose delivery</h5>
    						<h6 class="card-subtitle mb-2 text-muted"><?= $item->getName()." - ".$item->getPrice()."$" ?></h6>
    						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    						<a href="#" class="card-link">Glovo delivery</a>
    						<a href="#" class="card-link">Bolt Food</a>
  						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
		crossorigin="anonymous">
</script>
</body>
</html>
