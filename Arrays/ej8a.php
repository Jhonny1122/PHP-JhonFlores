<?php

$BaseDatos = array ("Juan" => 7, "David" => 3, "Jhon" => 5, "Diana" => 9, "Alicia" => 7);

echo "ALUMNO DE BASE DE DATOS : " . "<br>". "<br>";

foreach ($BaseDatos as $x => $x_valor){
	
	echo "Alumno/a=" . $x . ",Nota=" . $x_valor . "<br>";
}

echo "<br>";

arsort($BaseDatos);

echo "Mostramos al alumno con mayor nota : " .current($BaseDatos) . "<br>";

echo "<br>";

asort($BaseDatos);

echo "Mostramos al alumno con menor nota : " .current($BaseDatos) . "<br>";

echo "<br>";

$media=0;

$BaseDatosNotas=array_values($BaseDatos);

for ($i = 0 ; $i < count($BaseDatosNotas) ; $i++){
	
	$media+=$BaseDatosNotas[$i];
	
}

echo "Media de notas de los alumnos : " . $media/count($BaseDatosNotas);


?>