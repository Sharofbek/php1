<?php
$a = rand(0,15);
echo "Using switch and case \n";
switch($a){
	case 0:
		echo "0 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15";
		break;
	case 1:
		echo "1 2 3 4 5 6 7 8 9 10 11 12 13 14 15";
		break;
	case 2:
		echo "2 3 4 5 6 7 8 9 10 11 12 13 14 15";
		break;
	case 3:
		echo "3 4 5 6 7 8 9 10 11 12 13 14 15";
		break;
	case 4:
		echo "4 5 6 7 8 9 10 11 12 13 14 15";
		break;
	case 5:
		echo "5 6 7 8 9 10 11 12 13 14 15";
		break;
	case 6:
		echo "6 7 8 9 10 11 12 13 14 15";
		break;
	case 7:
		echo "7 8 9 10 11 12 13 14 15";
		break;
	case 8:
		echo "8 9 10 11 12 13 14 15";
		break;
	case 9:
		echo "9 10 11 12 13 14 15";
		break;
	case 10:
		echo "10 11 12 13 14 15";
		break;
	case 11:
		echo "11 12 13 14 15";
		break;
	case 12:
		echo "12 13 14 15";
		break;
	case 13:
		echo "13 14 15";
		break;
	case 14:
		echo "14 15";
		break;
	default:
		echo "15";
}
echo "\nUsing \"FOR\"\n";
for($i = $a; $i<=15; $i++){
	echo $i." ";
}

