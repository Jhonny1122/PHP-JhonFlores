<?php

$daw1 = array("Bases Datos", "Entornos Desarrollo", "Programación");

$daw2 = array("Sistemas Informáticos","FOL","Mecanizado");

$daw3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

$arrayUnion = [];

for ($i = 0 ; $i < count($daw1) ; $i++){
	
	$arrayUnion[]=$daw1[$i];
}

for ($i = 0 ; $i < count($daw2) ; $i++){
	
	$arrayUnion[]=$daw2[$i];
}

for ($i = 0 ; $i < count($daw3) ; $i++){
	
	$arrayUnion[]=$daw3[$i];
}

print_r ($arrayUnion);

/* Unio de arrays con array_merge */

echo "</BR>";

$arrayUnion2 = array_merge($daw1,$daw2,$daw3);

print_r ($arrayUnion2);

/* Unio de arrays con array_push */

echo "</BR>";

$arrayUnion3 = [];

for ($i = 0 ; $i < count($daw1) ; $i++){
	
	$daw1[$i];
	
	array_push($arrayUnion3,$daw1[$i]);
}

for ($i = 0 ; $i < count($daw2) ; $i++){
	
	$daw2[$i];
	
	array_push($arrayUnion3,$daw2[$i]);
}

for ($i = 0 ; $i < count($daw3) ; $i++){
	
	$daw3[$i];
	
	array_push($arrayUnion3,$daw3[$i]);
}

print_r ($arrayUnion);

?>