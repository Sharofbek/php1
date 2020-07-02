<?php 
require_once "db.php";
	
	if(!empty($_POST)){
		if (isset($_POST['feedback']) && isset($_POST['name'])) {
			// var_dump($_POST);
			$name = addslashes(strip_tags($_POST['name']));
			$feedback= addslashes(strip_tags($_POST['feedback']));
			$sql = "INSERT INTO feedbacks (name, feedback) VALUES (\"$name\", \"$feedback\")";
			if(mysqli_query($conn, $sql)){
				echo "<h2 align='center'>Congratulations your feedback sended Successfully !</h2>";
			}else {
				echo "<h2 align='center'>Something went wrong. Please Try again !</h2>";
			}
		}else{
			echo "<h2 align='center'>Something went wrong. Please Try again !</h2>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Task3</title>
</head>
<body>
	<div class="conatiner" align="center">
		<form action="task3.php" method="POST" style="padding-top:10%">
		<label for="name">
			Name:
		</label>
		<input type="text" name="name" id="name" required=""><br>
		<label for="feedback">
			Your feedback:
		</label><br>
		<textarea name="feedback" id="feedback" cols="50" rows="10" required=""></textarea><br>
		
		<input type="submit">
	</form>
	</div>
	
</body>
</html>