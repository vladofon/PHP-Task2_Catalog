<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/db/DataSource.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/service/GoodsService.php');

	$dataSource = new DataSource;
	$connection = $dataSource->getConnection();

	$goodsService = new GoodsService($connection);

	$goodsItem = $goodsService->getOne($_GET['id']);
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
				<div class="col mb-3">
					<h3>Create new Item</h3>
					<form action="/controller/ItemUpdateController.php" method="post">
						<input type="hidden" name="id" value="<?= $goodsItem->getId(); ?>">
						<div class="mb-3">
						  <label for="nameControl" class="form-label">Name</label>
						  <input value="<?= $goodsItem->getName(); ?>" name="name" type="text" class="form-control" id="nameControl" placeholder="Enter item name">
						</div>
						<div class="mb-3">
						  <label for="descriptionControl" class="form-label">Description</label>
						  <textarea name="description" class="form-control" id="descriptionControl" rows="3"><?= trim($goodsItem->getDescription()); ?>
						  </textarea>
						</div>
						<div class="mb-3">
						  <label for="priceControl" class="form-label">Price</label>
						  <input value="<?= $goodsItem->getPrice(); ?>" name="price" type="text" class="form-control" id="priceControl" placeholder="Enter item price">
						</div>
						<div class="mb-3">
						  <label for="countControl" class="form-label">Count</label>
						  <input value="<?= $goodsItem->getCount(); ?>" name="count" type="text" class="form-control" id="countControl" placeholder="Enter count of items">
						</div>
						<div class="mb-3">
						  <label for="imageControl" class="form-label">Image</label>
						  <input value="<?= $goodsItem->getCover(); ?>" name="cover" type="text" class="form-control" id="imageControl" placeholder="Paste image link">
						</div>
						<div class="mb-3">
					    	<button type="submit" class="btn btn-success">Confirm</button>
					  	</div>
					</form>
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