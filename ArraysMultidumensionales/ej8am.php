<?php
// Valores de la Matriz 1
$matriz1 = array(
array(2,0,1),
array(3,0,0),
array(5,1,1)
);
// Valores de la Matriz 2
$matriz2 = array(
array(1,0,1),
array(1,2,1),
array(1,1,0)
);
$suma = array(); // Iniciamos la matriz de resultados

if(count($matriz1) == count($matriz2)){ // Verificamos que las 2 matrices tengan el mismo tamaño de filas

for($i=0; $i<count($matriz1); $i++){ // Recorremos cada fila
	$suma[] = array(); // Creamos una entrada por cada fila
	if( count($matriz1[$i])==count($matriz2[$i])){ // Verificamos que las 2 matricies tengan las mismas columnas
		for($j=0; $j<count($matriz1[$i]); $j++){ // Recorremos las columnass
			$suma[$i][] = $matriz1[$i][$j]  + $matriz2[$i][$j]; // Realizamos la suma o resta, cambiar simbolo +/-
		}
	}
}
}
var_dump($matriz1);
var_dump($matriz2);
var_dump($suma);
?>
