<?php

$numero=22;

$base=16;

$resto=0;

$cerrar=false;

echo "Numero $numero en binario = ";

while ($cerrar == false){
	
	$resto=$numero%$base;
	
	$array=array($resto);
	
	$numero=$numero/$base;
	
	echo "$resto";
	
	if ($numero < $base){
		
		$cerrar=true;
		
		echo intval($numero);
	}
	
}
?>

<!-- Falta dar la vuelta al resultado y cambiar a letras a partir del 10->