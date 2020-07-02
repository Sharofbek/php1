<?php
function make_thumb($src, $dest, $desired_width) {

	/* read the source image */
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);

	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));

	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

	/* create the physical thumbnail image to its destination */
	imagejpeg($virtual_image, $dest);
}
function png2jpg($filePath){
	$image = imagecreatefrompng($filePath.'.png');
	$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
	imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
	imagealphablending($bg, TRUE);
	imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
	imagedestroy($image);
	$quality = 50; // 0 = worst / smaller file, 100 = better / bigger file 
	imagejpeg($bg, $filePath . ".jpg", $quality);
	imagedestroy($bg);
}

//make_thumb('src/images/image1.jpg', 'src/images/thumbs/image1.jpg', 255);
