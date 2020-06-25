<?php
function solve($a,$b,$operator){
	switch($operator){
		case "+":
			return $a+$b;
		case "-":
			return $a-$b;
		case "*":
			return $a*$b;
		case "/":
			return $a/$b;
	}
}

$x = rand(-10, 10);
$y = rand(-10, 10);
echo "$x - $y = ".solve($x, $y, '-');
echo "\n$x + $y = ".solve($x, $y, '+');
echo "\n$x * $y = ".solve($x, $y, '*');
echo "\n$x / $y = ".solve($x, $y, '/');
