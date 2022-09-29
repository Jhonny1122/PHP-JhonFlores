<?php

$numero=6;

$resto=0;

$cerrar=false;

echo "Numero $numero en binario = ";

while ($cerrar == false){
	
	$resto=$numero%2;
	
	$array=array($resto);
	
	$numero=$numero/2;
	
	echo "$resto";
	
	if ($numero < 2){
		
		$cerrar=true;
		
		echo intval($numero);
	}
	
}
?>
<!-- Falta dar la vuelta al resultado ->