<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT']."src/db.php";
require_once $_SERVER['DOCUMENT_ROOT']."src/helpers.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aroma Shop - Product Details</title>
  <link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="<?= url("public/vendors/bootstrap/bootstrap.min.css")?>">
  <link rel="stylesheet" href="<?= url("public/vendors/fontawesome/css/all.min.css")?>">
  <link rel="stylesheet" href="<?= url("public/vendors/themify-icons/themify-icons.css")?>">
  <link rel="stylesheet" href="<?= url("public/vendors/linericon/style.css")?>">
  <link rel="stylesheet" href="<?= url("public/vendors/nice-select/nice-select.css")?>">
  <link rel="stylesheet" href="<?= url("public/vendors/owl-carousel/owl.theme.default.min.css")?>">
  <link rel="stylesheet" href="<?= url("public/vendors/owl-carousel/owl.carousel.min.css")?>">

  <link rel="stylesheet" href="<?= url("public/css/style.css")?>">
</head>
<body>
  <!--================ Start Header Menu Area =================-->
  <header class="header_area fixed">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="<?= url("public/index.php")?>"><img src="<?= url("public/img/logo.png")?>" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
            <?php
              if(isLoggedIn())
                if(isAdmin($_SESSION['user_id'] ?? ($_COOKIE['user_id'] ?? 0))){
                  echo '<li class="nav-item"><a class="nav-link" href="'.url("admin").'">AdminHome</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="'.url("admin/products.php").'">ProductsCRUD</a></li>';
                  echo '<li class="nav-item"><a class="nav-link" href="'.url("admin/categories.php").'">CategoriesCRUD</a></li>';
                }
            ?>
              <li class="nav-item"><a class="nav-link" href="<?= url("public/index.php")?>">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="<?= url("public/products.php")?>">Products</a></li>

              <!-- <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Pages</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                  <li class="nav-item"><a class="nav-link" href="register.html">Register</a></li>                 
                  <li class="nav-item"><a class="nav-link" href="tracking-order.html">Tracking</a></li>
                </ul>
              </li> -->
              <!-- <li class="nav-item"><button><i class="ti-search"></i></button></li> -->
                      
              <li class="nav-item"><a class="nav-link" href="<?=url("public/contact.php")?>">Contact</a></li>

            </ul>
            
              <!-- <li class="nav-item"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">3</span></button> </li> -->
              <!-- <li class="nav-item"><a class="button button-header" href="#">Buy Now</a></li> -->
                <?php
                  if(isLoggedIn()){
                    $basket_counter = mysqli_query($conn, 'SELECT count(*) as counter FROM basket WHERE user_id ='.($_SESSION['user_id'] ?? ($_COOKIE['user_id'] ?? 0)));
                    $basket_counter = mysqli_fetch_assoc($basket_counter);
                    echo '<li class="button button-header"><a href="'.url("public/basket.php").'"><i class="ti-shopping-cart"></i><sup><span class="nav-shop__circle">'.(($basket_counter['counter'] == 0) ? '0': $basket_counter['counter']).'</span></sup></a></li>
                      <ul class="nav-shop">
                      <li class="nav-item submenu dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                          aria-expanded="false"><i class="ti-user"></i></a>
                        <ul class="dropdown-menu">
                          <li class="nav-item" style="margin:0;"><a class="nav-link" href="'.url("public/login.php?logout=1").'""><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
        </svg> Logout</a></li>
                        </ul>
                      </li>
                    ';
                  }else{
                    echo '<li class="button button-header"><a href="'.url('public/login.php').'">Login/Register</a></li>';
                  }
                ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <br clear="all">
  </header>
    <div style="margin-bottom:150px;"></div>
  <!--================ End Header Menu Area =================-->