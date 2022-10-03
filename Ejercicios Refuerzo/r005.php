<?php

$contador=0;

$total=0;

for ($i = 1 ; $i <= 100 ; $i+=3){
	
	echo "$i"."   ";
	
	$contador++;
	
	$total+=$i;
	
	if ($contador == 4){
		
		echo "Suma:$total";
		
		echo "</BR>";
		
		$contador=0;
		
		$total=0;
	}
}

?>