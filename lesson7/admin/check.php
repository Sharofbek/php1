<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'src/helpers.php';
	$ok = true;
	if( isLoggedIn() ){
		if( ! isAdmin($_SESSION['user_id'] ?? ($_COOKIE['user_id'] ?? 0))){
			$ok = false;
		}
	}else{
		$ok = false;
	}
	if(!$ok){
		header("Location: ".env("APP_URL").'public');
		exit();
	}
?>