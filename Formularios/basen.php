<?php

$numero = limpiar ($_POST["numero"]);

$base = limpiar ($_POST["base"]);

$baseNueva = obtenerBase($numero);

$numeroNuevo = obtenerNumero($numero);

$numeroConvertido = convertir($numeroNuevo, $baseNueva, $base);

echo "<h1>Cambio de Base</h1>";

echo "<br>";

echo "Numero " . $numeroNuevo . " en base " . $baseNueva . "= " . $numeroConvertido . " en base " . $base;


// Zona de Funciones //

function obtenerNumero ($a){
	// Guardamos en la variable, de la posicion 0 hasta que encuentre "/" en la variable a.
	$noBase=substr($a,0,strpos($a,'/'));
	
	return $noBase;
}

function obtenerBase($a){
	// Guardamos en la variable, desde que encuentre "/" en adelante.
	$base=substr($a,strpos($a,'/')+1);
	
	return $base;
}

function convertir ($a, int $b, int $c){
	// Hacemos un cast de int a string para la funcion siguiente.
	$a = strval($a);
	// $a tiene que ser si o si string.
	return base_convert($a, $b, $c);
}

function limpiar($numero){
	
	$numero = trim($numero);
	
	$numero = stripslashes($numero);
	
	$numero = htmlspecialchars($numero);
	
	return $numero;
}

?>