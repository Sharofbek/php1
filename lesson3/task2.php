<?php
$i=0;
do{
	if($i%2==0 && $i!=0)
		echo "$i – четное число.\n";
	elseif($i%2==1)
		echo "$i – нечетное число.\n";
	else
		echo "$i – ноль.\n";
}while($i++<10);
