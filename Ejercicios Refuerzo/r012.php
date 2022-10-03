<?php

$v1=0;

$v2=1;

echo $v1."</BR>";

for ($i = 0 ; $i <= 15 ; $i++){
	
	$acumulador=$v1;
	
	$v1=$v2;
	
	$v2 = $acumulador + $v1;
	
	echo $v1."</BR>";
}

?>