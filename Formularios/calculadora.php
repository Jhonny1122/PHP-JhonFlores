<?php

echo "El method que ha usado es: ",$_SERVER['REQUEST_METHOD'],"<br>";

echo "<h1>Calculadora</h1>";

$num1 = $_POST["operando1"];

$num2 = $_POST["operando2"];

$signo = $_POST["signo"];

if ($signo == "suma"){
	
	$solucion = $num1 + $num2;
}
else if ($signo == "resta"){
	
	$solucion = $num1 - $num2;
}
else if ($signo == "multiplicar"){
	
	$solucion = $num1 * $num2;
}
else if ($signo == "diviaion"){
	
	$solucion = $num1 / $num2;
}

echo "Resultado de la operacion : $num1 y $num2 = " . $solucion;


?>
