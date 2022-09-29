<?php

$numero=5;

$total=0;

echo "$numero!=$numero"."x";

for ($i = ($numero-1) ; $i > 0 ; $i--){
	
	$numero=$numero*$i;
	
	$total=$numero;
	
	if ($i == 1){
		
		echo $i;
	
	}else {

		echo "$i"."x";	
	}
}

echo "=$total";

?>