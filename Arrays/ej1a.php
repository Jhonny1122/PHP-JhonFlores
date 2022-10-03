<?php

$array;

$valor=1;

$suma=0;

for ($i = 0 ; $i < 20 ; $i++){
	
	$array[$i]=$valor;
	
	echo "Indice=" . $i . ", Valor=" . $valor .", ";
	
	$suma=$suma+$valor;
	
	$valor+=2;
	
	echo " Suma=" . $suma;
	
	echo "<br>";
}


?>