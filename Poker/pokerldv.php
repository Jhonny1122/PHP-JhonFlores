<?php
if (isset($_POST["submit"])){
// Variables //
$nombre1=limpiar($_POST["nombre1"]);
$nombre2=limpiar($_POST["nombre2"]);
$nombre3=limpiar($_POST["nombre3"]);
$nombre4=limpiar($_POST["nombre4"]);
$nombre5=limpiar($_POST["nombre5"]);
$nombre6=limpiar($_POST["nombre6"]);
$nombre7=limpiar($_POST["nombre7"]);
$nombre8=limpiar($_POST["nombre8"]);
$bote=limpiar($_POST["bote"]);
$correctoJugadores=false;
$baraja=array("1C1","1C2","1D1","1D2","1P1","1P2","1T1","1T2","JC1","JC2","JD1","JD2","JP1","JP2","JT1","JT2","KC1","KC2","KD1","KD2","KP1","KP2","KT1","KT2","QC1","QC2","QD1","QD2","QP1","QP2","QT1","QT2");
$jugadores=array();
// Llamar a las funciones //
$jugadores=validarJugadores($nombre1,$nombre2,$nombre3,$nombre4,$nombre5,$nombre6,$nombre7,$nombre8,$jugadores);
$correctoJugadores=validarNumJugadores($jugadores);
poker($jugadores,$correctoJugadores,$baraja);
}
// Funcion validar jugadores //
function validarJugadores($j1,$j2,$j3,$j4,$j5,$j6,$j7,$j8,$a){
	
	if (is_null($j1) == false){
	
		array_push($a,$j1);
	}
	
	if (is_null($j2) == false){
	
		array_push($a,$j2);
	}
	
	if (is_null($j3) == false){
	
		array_push($a,$j3);
	}
	
	if (is_null($j4) == false){
	
		array_push($a,$j4);
	}
	
	if (is_null($j5) == false){
	
		array_push($a,$j5);
	}
	
	if (is_null($j6) == false){
	
		array_push($a,$j6);
	}
	
	if (is_null($j7) == false){
	
		array_push($a,$j7);
	}
	
	if (is_null($j8) == false){
	
		array_push($a,$j8);
	}
	
	$a = array_diff($a, array("",0,null));
	
	return $a;
	
};

function validarNumJugadores($a){
	
	$correcto=false;
	
	if (count($a) < 4 || count($a) > 8){
		
		echo "Se necesita al menos 4 personas y como maximo 8 para poder empezar el juego." . "<br>";
	}
	else{
		
		$correcto = true;
	}
	
	return $correcto;
};
// Funcion dar importe al bombo //

// Funcion jugar al poker //
function poker($a,$bien1,$b){
/* Dentro de un bucle , recorrer todos los jugadores y asiganrles 4 cartas al azar */
/* Cuando se asigne la carta que se elimine esa carta del array de cartas */
/* Cuando termine de asignar cartas, recorrer el array de cartas de cada jugador y comprobar los resultados */
if($bien1 == true){
	
	$array1=array();
	
	for ($i = 0 ; $i < count($a) ; $i++){
		
		echo "Jugador : $a[$i]" . "<br>";
		
		for ($j = 0 ; $j < 4 ; $j++){
			
			$numero=array_rand($b);
			
			$array1[$j]=$numero;
		}
		
		$a[$i]=$array1;
		
		var_dump($a[$i]);
		
	}
	
}
else{
	
	echo "No se puede empezar el juego, vuelva a introducir los datos." . "<br>";
}

/* Se obtendra ek nombre del ganador y dependiendo de que haya sacado se ganara un % del premio */
};
// Funcion limpiar variables //
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>
