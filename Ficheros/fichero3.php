<?php

$cont = 0;

echo "<h1>Datos de los Alumno</h1>";

echo "<table>";

$fichero = fopen ("alumnos1.txt" , "r");
// feof es una funcion nos dice si hemos terminado con el fichero.
while (!feof($fichero)){
	
	$cont++;
	
	// fgets nos da la primera linea y despues salta a la siguiente.
	
	$linea = fgets($fichero);
	
	echo "<tr><td>";
	
	echo $linea . "</td></tr>";
}

echo "</table>";

echo "<br>";

echo "Se han leido " . ($cont-1) . " lineas";
	
fclose($fichero);

?>
