<?php

$array;

$valor=1;

$suma=0;

$mediaPares=0;

$mediaImpares=0;

for ($i = 0 ; $i < 20 ; $i++){
	/* Almacenamos en el array la posicion i y el valor */
	$array[$i]=$valor;
	// Mensaje donde le decimos el indice y el valorº
	echo "Indice=" . $i . ", Valor=" . $valor .", ";
	// En la variable suma almacenamos la suma de lo que haya en suma + el valor
	$suma=$suma+$valor;
	// Condicion para sacar la media de lo que haya en posiciones pares e impares
	if ($i%2 == 0){
		// Si el resto es 0, que sume lo que haya en mediaPares + valor
		$mediaPares=$mediaPares+$valor;
	}
	else {
		// Si no es 0 el resto que sume lo que haya en mediaImpares + valor
		$mediaImpares=$mediaImpares+$valor;
	}
	// Cada vuelta que aumente en 2
	$valor+=2;
	
	echo " Suma=" . $suma;
	
	echo "<br>";
}

echo "Media Pares=" . $mediaPares . ", Media Impares=" . $mediaImpares;

?>