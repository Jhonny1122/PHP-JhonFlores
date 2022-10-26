<?php
// Funcion ejercicio 1 //
function leerBolsa ($a){
	
	while (!feof($a)){
		
		$linea = fgets($a);
		
		echo $linea . "<br>";
	}
};

// Funcion ejercicio 2 //
function mostrarValor($a,$b){
	
	$contador=0;
	
	$guardarLinea=0;
	
	while (!feof($a)){	// Bucle para leer todas las lineas
		
		$linea = fgets($a);	// Lee la primera linea y despues salta a la siguiente.
		
		$pos = strpos ($linea,$b);	// Guardamos en pos si encuentra en la linea el valor que indicamos.
		
		if ($pos === false){	// Condicion para saber si lo encontro o no.
			
			$contador++;	// Sino lo encontro que sume el contador.
		}
		else {
			
			echo "Se ha encontrado la palabra $b en la linea $contador" . "<br>";
			
			$guardarLinea=$contador;	// Guardamos en guardarLinea lo que haya en contador, lo usamos para saber cuantas lineas lleva leidas.
		}
	};
	
	echo $guardarLinea; 
	
	while (!feof($a)){
		
		$linea = fgets($a);
    
		echo $linea . "<br>";
	};
};

// Funcion para depurar variables //
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>