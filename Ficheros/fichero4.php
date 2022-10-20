<?php

$cont = 0;

echo "<h1>Datos de los Alumno</h1>";

echo "<table border=1>";

$fichero = fopen ("alumnos2.txt" , "r");
// feof es una funcion nos dice si hemos terminado con el fichero.
while (!feof($fichero)){
	
	// fgets nos da la primera linea y despues salta a la siguiente.
	
	$linea = fgets($fichero);
	
	echo "<tr><td>";
	
	echo $linea . "</td></tr>";
	
	$cont++;
}

echo "</table>";

echo "<br>";

echo "Se han leido " . ($cont-1) . " lineas";
	
fclose($fichero);

?>