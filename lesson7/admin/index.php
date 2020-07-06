<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	require_once $_SERVER['DOCUMENT_ROOT'].'admin/check.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'public/header.php';
?>
	<div class="container" style="margin-top: 150px; min-height: 250px;">
		<h2>Main admin page</h2>
		<div class="row">
			<div class="col-md-4 ">
				<a class="btn btn-primary" href="<?=url('admin/products.php')?>">Products</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 mt-2">
				<a class="btn btn-primary" href="<?=url('admin/categories.php')?>">Categories</a>
			</div>
		</div>
	</div>

<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'public/footer.php';
?>