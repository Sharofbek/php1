<?php
$cities = [
	"Московская область"=>[
		"Москва", "Зеленоград", "Клин"
	],
	"Белгородская область"=>[
		"Алексеевка","Белгород","Бирюч","Валуйки"
	],
	"Брянская область"=>[
		"Дятьково","Жуковка","Злынка","Карачев","Клинцы"
	],
	"Владимирская область"=>[
		"Александров","Владимир","Вязники","Гороховец"
	]
];
$list = "<ol>";
// Для браузеров
foreach($cities as $k => $city){
	$list .= "<li>$k<ul>";
	foreach($city as $c){
		if(mb_substr($c,0,1)=='К'){
			$list.="<li>$c</li>";
		}
	}
	$list .= "</ul></li>";
}
$list .= "</ol>";
echo $list;


echo "\n\n";

foreach($cities as $k => $city){
	echo $k." : \n\t";
	foreach($city as $j => $c){
		if(mb_substr($c,0,1)=='К'){
			echo $c;
			if($j < (count($city)-1))
				echo ', ';
		}
	}
	echo "\n";
}

