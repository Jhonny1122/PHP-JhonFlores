<?php

$frase="En un lugar de la Mancha";

$contadorA=0;

$contadorE=0;

$contadorI=0;

$contadorO=0;

$contadorU=0;

for ($i = 0 ; $i < strlen($frase) ; $i++){
	
	if ($frase[$i] == "a"  || $frase[$i] == "A"){
			
		$contadorA++;
	}
	
	if ($frase[$i] == "e" || $frase[$i] == "E"){
			
		$contadorE++;
	}
	
	if ($frase[$i] == "i" || $frase[$i] == "I"){
			
		$contadorI++;
	}
	
	if ($frase[$i] == "o" || $frase[$i] == "O"){
			
		$contadorO++;
	}
	
	if ($frase[$i] == "u"  || $frase[$i] == "U"){
			
		$contadorU++;
	}
	
}

if ($contadorA > 0){	

	echo "a - $contadorA veces"."</BR>";
}

if ($contadorE > 0){	

	echo "e - $contadorE veces"."</BR>";
}

if ($contadorI > 0){	

	echo "i - $contadorI veces"."</BR>";
}

if ($contadorO > 0){	

	echo "o - $contadorO veces"."</BR>";
}

if ($contadorU > 0){	

	echo "u - $contadorU veces"."</BR>";
}

?>