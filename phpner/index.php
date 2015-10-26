<?php


$fib = array();
$fib[0] = 1;
$fib[1] = 1;

echo $fib[0] . $fib[1];

$x = 50;

for ($i=2; $i<$x ; $i++){
	
	$fib[$i] = $fib[$i-1] + $fib[$i-2];
	
	echo $fib[$i]." ";
	
}



?>