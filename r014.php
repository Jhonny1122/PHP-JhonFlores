<?php

$contador=0;

$contadorB=0;

$n="N";

$b="B";

for ($i = 0 ; $i < 64 ; $i++){
	
	$contador++;
	
	if($contador >= 0){
		
		if($i%2 == 1){
		
			echo "$n";
		}
	
		if($i%2 == 0){
		
			echo "$b";
		
		}
	}	
	if ($contador == 8){
		
		$contadorB++;
		
		echo "</BR>";
		
		$contador=0;
		
		$n="B";
		
		$b="N";
		
	}
	
	if ($contadorB%2==0){
		
		$n="N";
		
		$b="B";
	}
}

?>