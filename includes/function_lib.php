<?php
	function multiexplode ($delimiters,$string) {
    	$replace = str_replace($delimiters, $delimiters[0], $string);
    	$output = explode($delimiters[0], $replace);
    	return  $output;
	}
?>