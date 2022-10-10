<?php


$nota = array (
	"Daniel" => array ("Ciencias" => 5 , "Latin" =>3 , "Ingles" => 8 , "Artes" => 6),
	
	"Laura" => array ("Ciencias" => 9 , "Latin" =>2 , "Ingles" => 4 , "Artes" => 5),
	
	"Aurora" => array ("Ciencias" => 3 , "Latin" =>6 , "Ingles" => 8 , "Artes" => 5),
	
	"Diego" => array ("Ciencias" => 7 , "Latin" =>4 , "Ingles" => 7 , "Artes" => 9)

);

echo "ALUMNOS Y SUS NOTAS : ";

echo "<br>";

foreach ($nota as $lineaUno => $lineaUno_valor){
	
	echo "$lineaUno => ";
	
	foreach ($lineaUno_valor as $x => $x_valor){
		
		echo "Asignatura=$x ,Nota=$x_valor" .  " ";
	}
	
	echo "<br>";
}

echo "<br>";

echo "ALUMNO CON MAYOR NOTA: ";



echo "<br>";




?>
