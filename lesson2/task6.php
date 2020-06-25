<?php


function power($val, $pow){
	if($pow){
		return $val*power($val,--$pow);
	}
	return 1;
}
echo power(2,3);
