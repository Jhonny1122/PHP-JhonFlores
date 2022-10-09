<?php

$alumnos = array ("Alex" => 23, "Diego" => 27, "Laura" => 21, "Daniel" => 25, "Sonia" => 19);

echo "=============================================" . "</BR>";

echo "Mostrar el contenido del array utilizando bucles." . "</BR>";

echo "=============================================" . "</BR>";

foreach ($alumnos as $x => $x_valor){
	
	echo "Nombre=" . $x . ", Edad=" . $x_valor;
	
	echo "<br>";

}


echo "=============================================" . "</BR>";

echo "Sitúa el puntero en la segunda posición del array y muestra su valor" . "</BR>";

echo "=============================================" . "</BR>";

echo $alumnos["Diego"];

echo "</BR>";


echo "=============================================" . "</BR>";

echo "Avanza una posición y muestra el valor" . "</BR>";

echo "=============================================" . "</BR>";

echo "Posición inicial y muestra el valor= ".current($alumnos) . "<br>";

echo "Avanza una posición y muestra el valor= ".next($alumnos). "<br>";

echo "<br>";


echo "=============================================" . "</BR>";

echo "Coloca el puntero en la última posición y muestra el valor" . "</BR>";

echo "=============================================" . "</BR>";

echo "Puntero en la última posición y muestra el valor= ".end($alumnos). "<br>";

echo "<br>";


echo "=============================================" . "</BR>";

echo "Ordena el array por orden de edad (de menor a mayor) y muestra la primera posición del
array y la última" . "</BR>";

echo "=============================================" . "</BR>";

asort($alumnos);

foreach ($alumnos as $x => $x_valor){
	
	echo "Nombre=" . $x . ", Edad=" . $x_valor;
	
	echo "<br>";

}

echo "</BR>";

echo "Posición inicial y su valor= ".current($alumnos) . "<br>";

echo "Posición final y su valor= ".end($alumnos);


?>