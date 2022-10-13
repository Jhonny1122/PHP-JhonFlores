<?php

$decimal = $_POST["decimal"];

$binario = conversor($decimal);

echo "<h1>Conversor Binario</h1>";

echo "Numero Decimal: " . $decimal ;

echo "<br>";

echo "<br>";

echo "Numero Binario: " . $binario ;


function conversor ($a){
	
	return decbin($a);
}

?>