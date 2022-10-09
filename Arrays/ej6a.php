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

?>