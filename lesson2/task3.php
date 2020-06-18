<?php

function plus($a, $b){
	return $a+$b;
}

function minus($a,$b){
	return $a-$b;
}
function mult($a,$b){
	return $a*$b;
}
function div($a, $b){
	return $a/$b;
}

$x = rand(-10,10);
$y = rand(-10,10);

echo "$x+$y =".plus($x,$y);
echo "\n$x-$y =".minus($x,$y);
echo "\n$x*$y =".mult($x,$y);
echo "\n$x/$y =".div($x,$y);
