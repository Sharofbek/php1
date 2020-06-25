<?php

function replaceSpace($text){
	$text = str_split($text);
	foreach($text as $index => $letter)
		if($letter === ' ')
			$text[$index] = '_';
	return implode('',$text);
}

echo replaceSpace("Assalomu Alaykum Yaxshimisiz?");
