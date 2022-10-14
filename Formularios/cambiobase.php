<?php

$decimal = limpiar ($_POST["decimal"]);

$base = $_POST["base"];

echo "<h1>Conversor Numerico</h1>";

echo "Numero Decimal: " . $decimal;

echo "<br>";

echo "<br>";

echo convertir ($decimal, $base);

function convertir(int $a , String $b){
	
	if ($b == 2){
		
		return "Numero Binario: " . decbin($a);
	}	 
	else if ($b == 8){
		
		return "Numero Octal: " . decoct($a);
	}
	else if ($b == 6){
		
		return "Numero Hexadecimal: " . dechex($a);
	}
	else if($b == "todos"){
		
		return "Numero Binario: " . decbin($a) . "<br>" .
			   "Numero Octal: " . decoct($a) . "<br>" .
			   "Numero Hexadecimal: " . dechex($a)
		;
	}
}

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>