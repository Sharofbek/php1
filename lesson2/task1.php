<?php
$a = rand(-100,100);
$b = rand(-100,100);
echo $a."\n";
echo $b."\n";
echo "Using If and else :\n";
if($a >= 0 && $b >= 0){
	echo $a-$b;
}else if ($a <0 && $b <0){
	echo  $a * $b;
}else {
	echo $a+$b;
}
echo "\n";

