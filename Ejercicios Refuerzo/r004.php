<?php

$contador=0;

for ($i = 5 ; $i <= 100 ; $i+=3){
	
	echo "$i"." - ";
	
	$contador++;
	
	if ($contador == 3){
		
		echo "</BR>";
		
		$contador=0;
	}
}

?>