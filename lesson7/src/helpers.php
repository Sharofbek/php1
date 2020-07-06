<?php

	$variables = parse_ini_file($_SERVER['DOCUMENT_ROOT'].".env");
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if(! function_exists('url')){
		function url($path){
			return env('APP_URL').$path;
		}
	}

	if(! function_exists('env')){
		function env($var, $default = null){
			global $variables;
			return $variables[$var] ?? $default;
		}
	}
	
	if(! function_exists('printIfError')){
		function printIfError($index){
			global $error;
			if(isset($error[$index]) && isset($error)){
				echo "<p class='error'>{$error[$index]}</p>";
			}
		}
	}
	


	if(! function_exists('isLoggedIn')){
		function isLoggedIn(){
			global $conn;
			if( !isset($_SESSION["is_logged"]) ){
				if(isset($_COOKIE['user_id']) && is_numeric($_COOKIE['user_id'])){
					$sql = "SELECT name FROM users WHERE id = ". intval($_COOKIE['user_id']);
					$res = mysqli_query($conn, $sql);
					$res = mysqli_fetch_assoc($res);
					$_SESSION['is_logged'] = (! is_null($res)) ? true : false;
				}else {
					return false;
				}
			}
			return $_SESSION['is_logged'];
		}
	}

	if(! function_exists('isAdmin')){
		function isAdmin($id){
			global $conn;
			if(!is_numeric($id)){
				return false;
			}else {
				if( ! isset($_SESSION["is_admin"]) ){
					$sql = "SELECT is_admin FROM users WHERE id = ". intval($id);
					$res = mysqli_query($conn, $sql);
					$res = mysqli_fetch_assoc($res);
					$_SESSION['is_admin'] = (! is_null($res)) ? $res : false; 
				}
				return $_SESSION['is_admin'];
			}
		}
	}

	if (! function_exists('resizeImage')) {
		function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 80){
			// Obtain image from given source file.
		    if (!$image = @imagecreatefromjpeg($sourceImage)){
		        return false;
		    }

		    // Get dimensions of source image.
		    list($origWidth, $origHeight) = getimagesize($sourceImage);

		    if ($maxWidth == 0) $maxWidth  = $origWidth;

		    if ($maxHeight == 0) $maxHeight = $origHeight;

		    // Calculate ratio of desired maximum sizes and original sizes.
		    $widthRatio = $maxWidth / $origWidth;
		    $heightRatio = $maxHeight / $origHeight;

		    // Ratio used for calculating new image dimensions.
		    $ratio = min($widthRatio, $heightRatio);

		    // Calculate new image dimensions.
		    $newWidth  = (int)$origWidth  * $ratio;
		    $newHeight = (int)$origHeight * $ratio;

		    // Create final image with new dimensions.
		    $newImage = imagecreatetruecolor($newWidth, $newHeight);
		    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
		    imagejpeg($newImage, $targetImage, $quality);

		    // Free up the memory.
		    imagedestroy($image);
		    imagedestroy($newImage);

		    return true;
		}
	}
?>