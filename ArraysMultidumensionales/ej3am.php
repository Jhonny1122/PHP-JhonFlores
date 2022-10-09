<?php

$numero=0;

for ($i = 0 ; $i < 3 ; $i++){
	
	for($j = 0 ; $j < 5 ; $j++){
		
		$numero+=2;
		
		echo $numero . " ";
	}
	
	echo "<br>";
}

echo "<br>";

$numero=0;

for ($i = 0 ; $i < 3 ; $i++){
	
	for($j = 0 ; $j < 5 ; $j++){
		
		$numero+=2;
		
		echo "($i,$j)=$numero pos $i,$j" . "<br>";
	}
}




?>