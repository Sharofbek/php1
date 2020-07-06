<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/check.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/db.php';
	$checker = false;
	if(sizeof($_POST)){
		if(!isset($_POST['category_id'])){
			$error['category'] = "You must select one of the category";
		}else{
			if(intval($_POST['category_id'])==0){
				$error['category'] = "You must select one of the category";
			}
		}

		if(!isset($_POST['name'])){
			$error['name'] = "You must enter name of new product";
		}
		
		if(!isset($_POST['id'])){
			$error['main'] = "There was an error";
		}else{
			if(!is_numeric($_POST['id']))
				$error['main'] = "There was an error";
		}
		
		if(!isset($_POST['description'])){
			$error['description'] = "You must enter description of new product";
		}


		if(!isset($_POST['price'])){
			$error['price'] = "You must enter <b>price</b> of new product";
		}else{
			if(!is_numeric($_POST['price'])){
				$error['price'] = "Price of product must be <b>integer</b>";
			}
		}
		$has_img = false;
		if(isset($_FILES['image'])){
			if(strpos($_FILES['image']['type'],'image') !== 0){
				// $error['image'] = "You must send image file!";
			}
			if ($_FILES['image']['size']>=5000000){
				$error['image'] = "File size must be less than 5 MiB!";
			}
			if ($_FILES['image']['error']===0){
				$has_img = true;
				// $error['image'] = "There is an error while uploading file!";
			}
		}

		if(!isset($error)){
			$checker = true;
			$id = intval($_POST['id']);
			$category_id = intval($_POST['category_id']);
			$price= floatval($_POST['price']);
			$name = addslashes(strval($_POST['name']));
			$description = addslashes(strval($_POST['description']));
			//image section
			if($has_img){
				$img_name = addslashes(md5($_FILES['image']['name'].$_FILES['image']['tmp_name'].time()).'.jpg');// for make name UNIQUE
				$img = [
					'lg'=>'public/img/product/lg/'.$img_name,
					'md'=>'public/img/product/md/'.$img_name,
					'sm'=>'public/img/product/sm/'.$img_name
				];
				if(move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$img['lg'])
				&& resizeImage($_SERVER['DOCUMENT_ROOT'].$img['lg'],$_SERVER['DOCUMENT_ROOT'].$img['md'],255,270)
				&& resizeImage($_SERVER['DOCUMENT_ROOT'].$img['lg'],$_SERVER['DOCUMENT_ROOT'].$img['sm'],70,70)){

					$sql = "UPDATE products  SET category_id = $category_id, name = \"$name\", description =\"$description\", price = \"$price\", img_lg = \"{$img['lg']}\", img_md =\"{$img['md']}\", img_sm = \"{$img['sm']}\" WHERE id = ".intval($id);
					if(mysqli_query($conn, $sql)){
						header("Location: ".url('admin/products.php'));
						exit();
					}else{
						$error['main']= "Updating  failed try again please!";
					}

				}else{
					$error['main']= "Updating  failed try again please!";
				}
			}else{
				$sql = "UPDATE products  SET category_id = $category_id, name = \"$name\", description =\"$description\", price = \"$price\" WHERE id = ".intval($id);
				if(mysqli_query($conn, $sql)){
					header("Location: ".url('admin/products.php'));
					exit();
				}else{
					$error['main']= "Updating  failed try again please!";
				}
			}			
		}
	}
	if(!$checker){
		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
			echo "<h1 align='center' >Product Not Selected :(</h1>";
			die();
		}
		$id = intval($_GET['id']);
		$product = mysqli_query($conn, "SELECT * FROM products where id = $id");
		$product = mysqli_fetch_assoc($product);
	}
	$categories = mysqli_query($conn, 'SELECT id, name FROM categories');
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
			<form autocomplete="off" action="<?= url('admin/updateProduct.php')?>" method="POST" enctype="multipart/form-data">
			    <input type="hidden" name="id" value="<?=$product['id']?>">
			  	<div class="form-group">
				    <label for="name">Name of product</label>
				    <input value="<?=$_POST['name'] ?? $product['name']?>" type="text" name="name" class="form-control" id="name" required="">
				    <?= printIfError('name')?>
			  	</div>
			  	<div class="form-group">
				    <label for="category">Choose Category of product</label>
				    <select name="category_id" id="category" class="form-control">
						<?php
				    		if(mysqli_num_rows($categories)){
				    			while($category = mysqli_fetch_assoc($categories)):
				    	?>
							<option value="<?=$category['id']?>" <?= $category['id']==$product['category_id'] ? "selected" : "" ?>><?=$category['name']?></option>
						<?php
				    			endwhile;
				    		}
				    	?>
					</select>
				    <?= printIfError('category')?>
			  	</div>
			  	<div class="form-group">
				    <label for="price">Price of product</label>
				    <input value="<?=$_POST['price'] ?? $product['price']?>" type="number" name="price" class="form-control" id="price" required="">
				    <?= printIfError('price')?>
			  	</div>
			  	<div class="form-group">
				    <label for="description">Description of product</label>
				    <textarea type="text" name="description" class="form-control" id="description" required=""><?= $_POST['description'] ?? $product['description']?></textarea>
				    <?= printIfError('description')?>
			  	</div>
			  	<div class="form-group">
			  		<img src="<?=url($product['img_lg'])?>" alt="<?=$product['name']?>" width='800'>
				    <label for="image">Upload Picture(s)</label>
				    <input type="file" name="image" class="form-control-file" id="image" accept=".jpg,.jpeg">
				    <?= printIfError('image')?>
			  	</div>
				<div class="form-group">
				    <input type="submit" class="btn btn-primary" value="Submit">
			  	</div>
			</form>
		</div>
	</div>
</div>
