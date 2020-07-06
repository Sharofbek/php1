<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/admin/check.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/src/db.php';
	if (isset($_POST['delete'])){
		$id = addslashes($_POST['delete']);
		if(is_numeric($id)){
			$sql = "DELETE FROM products WHERE id = $id";
			mysqli_query($conn, $sql);
		}
		$sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 100;";
	}else{
		if(isset($_POST['search'])){
			$search = addslashes($_POST['search']);
			$sql = "SELECT * FROM products where name like \"%{$search}%\" ORDER BY created_at DESC LIMIT 10";
		}else {
			$sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 100";
		}
	}
	$products = mysqli_query($conn, $sql);
	require_once $_SERVER['DOCUMENT_ROOT'].'/public/header.php';
?>
<div class="container" style="color: black; min-height: 500px;">
	<nav class="navbar navbar-light bg-light" style="padding: 0.5rem 0rem;">
	    <a class="btn btn-primary" href="<?= url('admin/newProduct.php')?>">
	        <svg class="bi bi-folder-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M9.828 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H9.828zm-2.95-1.707L7.587 3H2.19c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293z"/>
				<path fill-rule="evenodd" d="M13.5 10a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
				<path fill-rule="evenodd" d="M13 12.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
			</svg> Add
		</a>
	    <form class="form-inline" method="post" action="<?= url('admin/products.php')?>">
	        <input aria-label="Search" class="form-control mr-sm-2" name="search" placeholder="Search Product" type="search" required>
	            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
	                Search
	            </button>
	        </input>
	    </form>
	</nav>
	<?php
	  	if(!mysqli_num_rows($products)){
	  		echo "<h3 align='center' style='min-height:300px;'>There is not product(s)";
	  		if (isset($_POST['search'])){
	  			echo " Like \"{$_POST['search']}\"";
	  		}else{
	  			echo " yet";
	  		}
	  		echo "</h3>";
	  	}else{
	?>
	<table class="table table-striped">
	  <thead>
	    <tr>
			<th scope="col">#</th>
			<th scope="col">Name</th>
			<th scope="col">Price</th>
			<th scope="col">Image</th>
			<th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php
	  		while($product = mysqli_fetch_assoc($products)): ?>
	    <tr>
			<th scope="row"><?=$product['id']?></th>
			<td><?=$product['name']?></td>
			<td><?=$product['price']?></td>
			<td><img src='<?=url($product['img_sm'])?>' alt="No image for <?=$product['name']?>"></td>
			<td>
				<div class="row">
					<a href="<?=url("admin/updateProduct.php?id=".$product['id'])?>" class="btn btn-primary btn-sm">Edit</a>
					<form action="<?=url('admin/products.php')?>" method="POST">
						<input type="hidden" name="delete" value="<?=$product['id']?>">
						<input type="submit" value="Delete" class="btn btn-danger btn-sm">
					</form>
				</div>
			</td>
	    </tr>
	  	<?php 
	  		endwhile;
	  	}
	  	?>
	  </tbody>
	</table>	
</div>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'public/footer.php'
?>