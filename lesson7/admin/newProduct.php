<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/admin/check.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/db.php';
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

		if(!isset($_FILES['image'])){
			$error['image'] = "You must send picture of new product!";
		}else{
			if(strpos($_FILES['image']['type'],'image') !== 0){
				$error['image'] = "You must send image file!";
			}
			if ($_FILES['image']['size']>=5000000){
				$error['image'] = "File size must be less than 5 MiB!";
			}
			if ($_FILES['image']['error']!==0){
				$error['image'] = "There is an error while uploading file!";
			}
		}

		if(!isset($error)){
			$category_id = intval($_POST['category_id']);
			$price= floatval($_POST['price']);
			$name = addslashes(strval($_POST['name']));
			$description = addslashes(strval($_POST['description']));
			//image section
			$img_name = addslashes(md5($_FILES['image']['name'].$_FILES['image']['tmp_name'].time()).'.jpg');// for make name UNIQUE
			$img = [
				'lg'=>'public/img/product/lg/'.$img_name,
				'md'=>'public/img/product/md/'.$img_name,
				'sm'=>'public/img/product/sm/'.$img_name
			];

			if(
				move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$img['lg'])
				&& resizeImage($_SERVER['DOCUMENT_ROOT'].$img['lg'],$_SERVER['DOCUMENT_ROOT'].$img['md'],255,270)
				&& resizeImage($_SERVER['DOCUMENT_ROOT'].$img['lg'],$_SERVER['DOCUMENT_ROOT'].$img['sm'],70,70)
			){
				$sql = "INSERT INTO products (category_id, name, description, price, img_lg, img_md, img_sm) VALUES ($category_id, \"$name\",\"$description\",\"$price\",\"{$img['lg']}\",\"{$img['md']}\",\"{$img['sm']}\")";
				if(mysqli_query($conn, $sql)){
					header("Location: ".url('admin/products.php'));
					exit();
				}else{
					$error['main']= "Inserting to database failed try again please!";
				}
			}else{
				$error['image']="Image not uploaded to server side. Please try again!";
			}

			//end image section
			
		}
	}

	$categories = mysqli_query($conn, 'SELECT id, name FROM categories');
	// var_dump($categories);
	// die()
	require_once $_SERVER['DOCUMENT_ROOT'].'/public/header.php';
?>
<div class="container d-flex justify-content-center" style="position: relative;">
	<div class="card col-md-9 " style="position: absolute; ">
		<div class="card-header">
			<h3>Add new Product</h3>
			<?= printIfError('main')?>
		</div>
		<div class="card-body">
			<form autocomplete="off" action="<?= url('admin/newProduct.php')?>" method="POST" enctype="multipart/form-data">
			    <!-- <input type="hidden" name="verify" value="1"> -->
			  	<div class="form-group">
				    <label for="name">Name of product</label>
				    <input value="<?=$_POST['name'] ?? ''?>" type="text" name="name" class="form-control" id="name" required="">
				    <?= printIfError('name')?>
			  	</div>
			  	<div class="form-group">
				    <label for="category">Choose Category of product</label>
				    <select name="category_id" id="category" class="form-control">
						<option value="0">Select</option>
				    	<?php
				    		if(mysqli_num_rows($categories)){
				    			while($category = mysqli_fetch_assoc($categories)):
				    	?>
							<option value="<?=$category['id']?>"><?=$category['name']?></option>
						<?php
				    			endwhile;
				    		}else{
				    		}
				    	?>
					</select>
				    <?= printIfError('category')?>
			  	</div>
			  	<div class="form-group">
				    <label for="price">Price of product</label>
				    <input value="<?=$_POST['price'] ?? ''?>" type="number" name="price" class="form-control" id="price" required="">
				    <?= printIfError('price')?>
			  	</div>
			  	<div class="form-group">
				    <label for="description">Description of product</label>
				    <textarea type="text" name="description" class="form-control" id="description" required=""><?= $_POST['description'] ?? ""?></textarea>
				    <?= printIfError('description')?>
			  	</div>
			  	<div class="form-group">
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
