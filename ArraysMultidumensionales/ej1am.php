<?php

$numero=0;

for ($i = 0 ; $i < 3 ; $i++){
	
	$numero+=2;
	
	echo $numero . " ";
	
	for ($j = 0 ; $j < 2 ; $j++){
		
		$numero+=2;
		
		echo $numero . " ";
	}
	
	echo "<br>";
}

?>