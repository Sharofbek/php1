<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "db.php";
require_once "thumbMaker.php";
// const ROOT = $_SERVER['DOCUMENT_ROOT'];
if (isset($_POST['saveImage'])) {
	$newImage = $_FILES['newImage'];
	var_dump($newImage);
	$name = md5($newImage['name'].time()).'.jpg';
	$path = $_SERVER['DOCUMENT_ROOT'].'src/images/';
	$thumb_dest = $path.'thumbs/'.$name;
	$sql = "INSERT INTO images (path, size, thumb_path) VALUES (\"src/images/{$name}\",\"{$newImage['size']}\",\"src/images/thumbs/$name\")";
	if(move_uploaded_file($newImage['tmp_name'], $path.$name) && is_null(make_thumb($path.$name, $thumb_dest, 255)) && mysqli_query($conn,$sql)){
		header("Location: index.php");
	}
	die();
}
?>