<?php

// Я использовал рекурсивную функцию :)
function solve($arr, $result){
	$result .= "<ul>";
	foreach($arr as $k => $v){
		$result .="<li>";
		if(is_array($v)){
			$result .= "$k";
			$result = solve($arr[$k], $result);
		}else{
			$result .= "$v";
		}
		$reuslt .="</li>";
	}
	$result .= "</ul>";
	return $result;
}


$x = [
	'Menu1'=>[
		"li1Menu1","li2Menu1","li3Menu1","li4Menu1","li5Menu1"
	],
	"Menu2"=>[
		"li1Menu2"
	],
	"Menu3",
	"Menu4",
	"Menu5"=>[
		'li1Menu5'=>[
			'li1Menu51',
			'li1Menu52',
			'li1Menu53'
		],
		'li2Menu5'=>[
			'li2Menu51',
			'li2Menu52',
			'li2Menu53'
		],
		'li3Menu5'
	]
];

echo solve($x, "");
