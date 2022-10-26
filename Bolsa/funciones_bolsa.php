<?php
// Funcion ejercicio 1 //
function leerBolsa ($a){
	
	while (!feof($a)){
		
		$linea = fgets($a);
		
		echo $linea . "<br>";
	}
};

// Funcion ejercicio 2 //
/*Funcion que recibe como parametro el valor a buscar, y devuelve la linea donde se encuentra*/
function mostrarValor($a){	

	$lineas = file("ibex35.txt");	
	
	foreach ($lineas as $num_linea => $linea) {
		
		$primero = rtrim(substr($linea, 0, 23));

		if (rtrim($primero) == $a){
			
			echo $linea;
		};
	}

}
// Funcion para depurar variables //
/*Funcion donde pasas las variables y los limpia de caracteres raros*/
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>