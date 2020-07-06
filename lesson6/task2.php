<?php

	if (isset($_GET['action']) && isset($_GET)) {
		$action = $_GET['action'];
		if(!($action =='*' ||  $action =='+' || $action =='-'  || $action =='/'  )){
			echo "<h2 align='center'>Incorrect action selected !</h2>";
		}else{
			$value1 = (int)$_GET['value1'];
			$value2 = (int)$_GET['value2'];
			if($action=='/'){
				if($value2 == 0){
					echo "<h2 align='center'>Incorrect value for SECOND number !</h2>";
				}else{
					$res = $value1 / $value2;
				}
			}else if($action=="*"){
				$res = $value1 * $value2;
			}elseif($action=='+'){
				$res = $value1 + $value2;
			}elseif($action=='-'){
				$res = $value1 - $value2;
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Task1 Calculator1</title>
</head>

<body>
	<div class="container" align="center">
		<form action="task2.php" style="padding-top:20%">
			Num1: <input type="text" style="width:100px;" name="value1" required value="<?= $_GET['value1']?>" placeholder="Num1"><br>
			Num2:
			<input type="text" style="width:100px;" name= "value2"required value="<?= $_GET['value2']?>" placeholder="Num2">
			<br>
			<?php
				if(isset($res)){
					echo "<p style='display:inline-block;font-size:24px;'>$value1 $action $value2 = $res</p>";
				}
			?>
			<br>
			<input type="submit" name="action" value="+" style="width:25px;">
			<input type="submit" name="action" value="-" style="width:25px;">
			<input type="submit" name="action" value="*" style="width:25px;">
			<input type="submit" name="action" value="/" style="width:25px;">
			<br>
		</form>
	</div>
</body>
</html>