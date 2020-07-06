<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/check.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/db.php';
	$checker = false;
	if(sizeof($_POST)){
		if(!isset($_POST['name'])){
			$error['name'] = "You must enter name of new category";
		}else{
			if(strlen($_POST['name'])===0)
				$error['name'] = "You must enter name of new category";
		}
		if(!isset($_POST['id'])){
			$error['main'] = "There was an error";
		}else{
			if(!is_numeric($_POST['id']))
				$error['main'] = "There was an error";
		}

		if(!isset($error)){
			$checker = true;
			$id = addslashes($_POST['id']);
			$name = addslashes(strval($_POST['name']));
			$sql = "UPDATE categories SET name = \"$name\" WHERE id = ".intval($id);
			if(mysqli_query($conn, $sql)){
				header("Location: ".url('admin/categories.php'));
				exit();
			}else{
				$error['main']= "Updating  failed try again please!";
			}
		}
	}
	if(!$checker){
		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
			echo "<h1 align='center'>Something Went Wrong :(</h1>";
			die();
		}
		$id = intval($_GET['id']);
		$category = mysqli_query($conn, "SELECT * FROM categories where id = $id");
		$category = mysqli_fetch_assoc($category);
	}
	// var_dump($categories);
	// die()
	require_once $_SERVER['DOCUMENT_ROOT'].'/public/header.php';
?>
<div class="container d-flex justify-content-center" style="position: relative;">
	<div class="card col-md-9 " style="position: absolute; ">
		<div class="card-header">
			<h3>Updating Product</h3>
			<?= printIfError('main')?>
		</div>
		<div class="card-body">
			<form autocomplete="off" action="<?= url('admin/updateCategory.php')?>" method="POST" enctype="multipart/form-data">
			    <input type="hidden" name="id" value="<?=$category['id']?>">
			  	<div class="form-group">
				    <label for="name">Name of product</label>
				    <input value="<?=$_POST['name'] ?? $category['name']?>" type="text" name="name" class="form-control" id="name" required="">
				    <?= printIfError('name')?>
			  	</div>
				<div class="form-group">
				    <input type="submit" class="btn btn-primary" value="Submit">
			  	</div>
			</form>
		</div>
	</div>
</div>
