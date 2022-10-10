<?php

$arrayFila=array();

$arrayPromedio=array();

$mayor=0;

$total=0;

for ($i = 0 ; $i < 3 ; $i++){
	
	$total=0;
	
	for ($j = 0 ; $j < 3 ; $j++){
		
		$numero=rand(1,100);
		
		echo $numero . " ";
		
		if ($numero > $mayor){
			
			$mayor=$numero;
			
			$arrayFila[$i]=$mayor;
		}
		
		$total+=$numero;
		
	}
	
	$total=$total/3;
	
	$arrayPromedio[$i]=$total;
	
	$mayor=0;
	
	echo "<br>";
}

var_dump($arrayFila);

var_dump($arrayPromedio);

?>
