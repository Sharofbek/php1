<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/src/db.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/src/helpers.php';
if(isset($_POST['delete']) && is_numeric($_POST['delete']) ){
  $id = intval($_POST['delete']);
  $sql = "DELETE FROM basket WHERE user_id = ".($_SESSION['user_id'] ?? ($_COOKIE['user_id'] ?? 0))." AND product_id = $id";
  mysqli_query($conn, $sql);
}
if(!isLoggedIn()){
  header("Location: ".url('public/login.php'));
  exit();
}
$sql = "SELECT b.*, p.* FROM basket as b LEFT JOIN products AS p ON b.product_id = p.id WHERE b.user_id = ".($_SESSION['user_id'] ?? $_COOKIE['user_id']);
$products = mysqli_query($conn, $sql);
require_once $_SERVER['DOCUMENT_ROOT'].'/public/header.php';
?>
	<!-- ================ category section start ================= -->		  
  <div class="container" style="color: black; min-height: 500px;">
  <table class="table table-striped">
    <thead>
      <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Quatity</th>
      <th scope="col">Image</th>
      <th scope="col">Total Price</th>
      <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(mysqli_num_rows($products)==0){
          echo "<h3 align='center'>There is no Products Yet</h3>";
        }
        $ic = 1;
        while($product = mysqli_fetch_assoc($products)): ?>
      <tr>
      <th scope="row"><?=$ic++?></th>
      <td><?=$product['name']?></td>
      <td><?=$product['quantity']?></td>
      <td><img src='<?=url($product['img_sm'])?>' alt="No image for <?=$product['name']?>"></td>
      <td><?=$product['quantity']*$product['price']?></td>
      <td>
        <div class="row">
          <form action="<?=url('public/basket.php')?>" method="POST">
            <input type="hidden" name="delete" value="<?=$product['id']?>">
            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
          </form>
        </div>
      </td>
      </tr>
      <?php 
        endwhile;
      ?>
    </tbody>
  </table>  
</div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/public/footer.php';
?>
