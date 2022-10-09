<?php

$sumaFila=array();

$sumaColumna=array();

$total=0;

$numero=0;
//Fila
for ($i = 0 ; $i < 3 ; $i++){
	
	
	
	//Columna
	for ($j = 0 ; $j < 3 ; $j++){
		
		$numero+=2;
		
		echo $numero . " ";
		
		$sumaFila[$i]=$numero;
	}
	
	for ($l = 0 ; $l < count($sumaFila) ; $l++){
		
		$total+=$sumaFila[$l];
	}
	
	echo "=> Suma de la fila: "  . $total;
	
	echo "<br>";
}




?>