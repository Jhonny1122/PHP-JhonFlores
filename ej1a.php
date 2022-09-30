<?php

$valor=0;

$valor2=0;

$indice=0;

$array;

for($i = 0; $i <= 20 ; $i++){
	
	$valor++;
	
	if($valor%2 == 1){
		
		$array=array($i=>$valor);
		
		$valor2=$valor;
	}
	
	echo "Indice=$i, Valor=$valor2";
	
	echo "</BR>";
}






/*for ($i = 0 ; $i <= 20 ; $i++){
	
	$indice++;
	
	$valor++;
	
	if ($valor%2 == 1){
		
		$array=array($indice=>$valor);
		
		$suma=$suma+$valor;
		
		echo "Indice=" . $indice . ", Valor=" . $valor . ", suma=$suma";
		
		echo "</BR>";
	}

}
*/

?>