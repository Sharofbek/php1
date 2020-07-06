<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/check.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/db.php';
	if(sizeof($_POST)){
		
		if(!isset($_POST['name'])){
			$error['name'] = "You must enter name of new product";
		}

		if(!isset($error)){
			$name = addslashes(strval($_POST['name']));
			$sql = "INSERT INTO categories (name) VALUES (\"$name\")";
			if(mysqli_query($conn, $sql)){
				header("Location: ".url('admin/categories.php'));
				exit();
			}else{
				$error['main']= "Inserting to database failed try again please!";
			}
			
		}
	}
	require_once $_SERVER['DOCUMENT_ROOT'].'/public/header.php';
?>
<div class="container d-flex justify-content-center" style="position: relative;">
	<div class="card col-md-9 " style="position: absolute; ">
		<div class="card-header">
			<h3>Add new Category</h3>
			<?= printIfError('main')?>
		</div>
		<div class="card-body">
			<form autocomplete="off" action="<?= url('admin/newCategory.php')?>" method="POST">
			    <!-- <input type="hidden" name="verify" value="1"> -->
			  	<div class="form-group">
				    <label for="name">Name of product</label>
				    <input value="<?=$_POST['name'] ?? ''?>" type="text" name="name" class="form-control" id="name" required="">
				    <?= printIfError('name')?>
			  	</div>
				<div class="form-group">
				    <input type="submit" class="btn btn-primary" value="Submit">
			  	</div>
			</form>
		</div>
	</div>
</div>
