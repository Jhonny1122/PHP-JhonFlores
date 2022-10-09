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

echo "<br>";

$numero=0;

$fila=0;

$columna=0;

$mayor=0;

for ($i = 0 ; $i < 3 ; $i++){
	
	for($j = 0 ; $j < 5 ; $j++){
		
		$numero+=2;
		
		if ($numero > $mayor){
			
			$mayor=$numero;
			
			$fila=$i;
			
			$columna=$j;
		}
		
	}
}

echo "Elemento mayor: $mayor , Fila: $fila , Columna: $columna";


?>