<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/domain/Goods.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/db/DataSource.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/service/GoodsService.php');
?>
<?php
	$dataSource = new DataSource;
	$connection = $dataSource->getConnection();

	$goodsService = new GoodsService($connection);

	$goods = $goodsService->goodsList($_GET['filter'], $_GET['direction']);

	$itemsPerPage = 3;
	$currentPage = isset($_GET['page']) ? ($_GET['page'] - 1) : 0;
	$totalPages = ceil(count($goods) / $itemsPerPage);
	$page = array_slice($goods, $currentPage * $itemsPerPage, $itemsPerPage);

?>
<?php
	$direction = "";
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
		<div class="dropdown">
		  <?php
		  	if(isset($_GET['filter'])) {
		  ?>
		  	<button class="btn btn-secondary shadow disabled">
		  		<?= $_GET['filter'] ?>
		  	</button>
		  <?php
		  	}
		  ?>
		  <button class="btn btn-secondary dropdown-toggle shadow" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		    Change goods filter
		  </button>
		  <a href="

		  	<?php 
			  	if($_GET['direction'] == "asc") {
					$direction = "desc";
				} else {
					$direction = "asc";
				}; echo '/?filter='.$_GET['filter'].'&direction='.$direction; 
			?>" 

			class="btn btn-secondary shadow">
		  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
			  <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
			</svg>
		  </a>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		    <li><a class="dropdown-item" href="/?filter=price">By price</a></li>
		    <li><a class="dropdown-item" href="/?filter=count">By count</a></li>
		    <li><a class="dropdown-item" href="/?filter=date">By date</a></li>
		  </ul>
		</div>
	</h1>
	<div class="container my-5">
		<div class="row justify-content-start">	
			<?php
				foreach ($page as $key => $value) {
			?>
			<div class="col-3 m-3 mx-auto">

				<div class="card shadow-sm" style="width: 18rem;height: 100%;">
					<div style="height: 180px;background: url('<?= $value->getCover(); ?>') 0 0/cover no-repeat;">
						<!-- <img src="" class="card-img-top img-fluid" alt="..."> -->
					</div>
					<div class="card-body d-flex flex-column">
						<h5 class="card-title">
							<?= $value->getName(); ?>
						</h5>
						<p class="card-subtitle mb-2 text-muted">
							<?= $value->getPrice()."$"; ?>
						</p>
						<p class="card-text">
							<?= substr($value->getDescription(), 0, 100)."..."; ?>
						</p>
						<div class="mb-0 mt-auto d-flex justify-content-around">
							<a href="/page/GoodsItem.php?id=<?= $value->getId(); ?>" class="btn btn-primary">Show more</a>
							<div>
								<form action="/controller/ItemDeleteController.php" method="post" class="d-flex">
									<input type="hidden" name="id" value="<?= $value->getId(); ?>"/>
									<button type="submit" class="btn btn-outline-danger ml-2">Remove</button>
								</form>
							</div>
							<div>
								<a href="/page/UpdateItem.php?id=<?= $value->getId(); ?>" class="btn btn-outline-warning">
									Edit
								</a>
							</div>
						</div>
					</div>
				</div>

			</div>
			<?php
				}
			?>
			<div class="col-3 m-3 mx-auto">
				<div class="card shadow bg-info p-2 bg-opacity-10" style="width: 18rem; height: 100%; min-height: 424px">
					<p class="card-text my-auto mx-auto">
						
						<a href="/page/CreateItem.php" class="btn btn-lg btn-outline-success">
							+ Add new
						</a>
					</p>
				</div>
			</div>
		</div>	
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col">
				<nav class="d-flex justify-content-center" aria-label="Page navigation example">
				  <ul class="pagination">

				  	<?php
				  		$filter = "date";
				    	$direction = "desc";
				    	$visibleItems = 3;

				    	if(isset($_GET['filter'])) $filter = $_GET['filter'];
				    	if(isset($_GET['direction'])) $direction = $_GET['direction'];

				  		$navPrevState = "active";
				  		if(($currentPage) <= 0) $navPrevState = "disabled";
				  	?>

				    <li class="page-item <?= $navPrevState ?>"><a class="page-link" href="

				    	<?php
				    		echo '/?filter='
				    				.$filter.'&direction='
				    				.$direction.'&page='
				    				.($currentPage);
				    	?>

				    	">Previous</a></li>

				    <?php

				    	for($navPage = 1; $navPage <= $totalPages; $navPage++) {
				    		$state = "";
				    		if($navPage == $currentPage + 1) {
				    			$state = "active";
				    		}
				    		echo '<li class="page-item'.' '.$state.'"><a class="page-link" 
				    				href="/?filter='
				    				.$filter.'&direction='
				    				.$direction.'&page='
				    				.$navPage.'">'
				    				.$navPage.'</a></li>';
				    	}	

				    	$navNextState = "active";

				    	if(($currentPage + 1) >= $totalPages) $navNextState = "disabled";
				    ?>
				   
				    <li class="page-item <?= $navNextState ?>"><a class="page-link" href="

				    	<?php
				    		echo '/?filter='
				    				.$filter.'&direction='
				    				.$direction.'&page='
				    				.($currentPage + 2);
				    	?>

				    	">Next</a></li>
				  </ul>
				</nav>
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