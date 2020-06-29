<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"/>
    <title>Image Oceans</title>
  </head>
  <body>
   	<div class="container">
   		<h3>Adding new image</h3>
		<form action="server.php" enctype="multipart/form-data" method="POST">
			<input type="hidden" name='saveImage' value="1">
			<div class="form-group">
				<label for="exampleFormControlFile1">Select Image file:</label>
				<input type="file" name='newImage' class="form-control-file" id="exampleFormControlFile1" accept="image/*" required>
			</div>
			<input type="submit" class="btn btn-primary" value="Add">
		</form>
	</div>
</body>
</html>
