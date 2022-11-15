<?php

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
	
	$contador=0;
	
	echo "<h1>Juego de POKER</h1>";
	
	echo "<table border=1>";
	
	for ($i = 0 ; $i < count($a) ; $i++){
		
		echo "<tr><td>Jugador " . ($i+1) . " : $a[$i]</td>";
		
		for ($j = 0 ; $j < 4 ; $j++){
			
			$pos=shuffle($b); // Cogemos un valor aleatorio del array $b(baraja) //
			
			$pos=$b[$j];
			
			echo "<td>Carta " . ($j+1) . " : $pos</td>";
			
			$pos=substr($pos,0,1);
			
			$array1[$j]=$pos;
		}
		
		sort($array1);
		
		$a[$i]=$array1;
		
		echo "</td></tr>";		
		
	}
	
	echo "</table>";
	
	echo "<br>";
	
	return $a;
	
}
else{
	
	echo "No se puede empezar el juego, vuelva a introducir los datos." . "<br>";
}

};
/* Funcion donde pasamos por paramtros el array con los jugadores y sus respectivas cartas. Al final nos dira quien gano y su recompensa*/
function ganador ($a,$b){
	
	//var_dump($a);
	
	$contador=1;
	
	$arraypoker=array();
	
	$arraytrio=array();
	
	$arraydoble=array();
	
	$arraypareja=array();
	
	$doble=false;
	
	for($i = 0 ; $i < count($a) ; $i++){	// Bucle para recorrer los jugadores.
		
		echo "Jugador " . ($i+1) . " :";	// Imprimimos los jugadores.
		
		for($j = 0 ; $j < 3 ; $j++){		// Bucle para recorrer sus cartas de cada jugador.
			
			if($a[$i][($j+1)]===$a[$i][$j]){	// Condicion donde comparamos si son iguales , la posicion siguiente(j+1) con la posicion actual o anterior(j). Si son iguales hara lo siguiente.
				
				$contador++;				// Aumentamos en 1+ el contador
				
				if ($contador == 3 && $a[$i][3]===$a[$i][2] && $a[$i][0]===$a[$i][1]){		// Condicion donde comprobamos 3 cosas, si el cotnador es igual a 3 , si los elementos de la posicion 3 y 2 son iguales y si
																							// los elementos de la posicion 0 y 1 son iguales.
					$doble=true;	// Cambiara a true la variable doble
				}
			}
		}
		
		if($contador == 1){			// Condicion si el contador tiene como valor 1 , imprima lo siguiente.
			
			echo "No ha sacado nada" . "<br>";
		}

		if($contador == 2){			// Condicion si el contador tiene como valor 2 , imprima lo siguiente.
			
			echo "Ha sacado pareja" . "<br>";
			
			array_push($arraypareja,($i+1));	
		}
		
		if($contador == 3 && $doble===true){ // Condicion si el contador tiene como valor 3 y es true , imprima lo siguiente. IMPORTANTE!!! Ten cuidado con los sginos === , == y = . Cuando quieras algo exactamente igual usa ===
			
			echo "Ha sacado doble pareja" . "<br>";
			
			$doble=false;					// Cambiamos de nuevo su valor a false.
			
			array_push($arraydoble,($i+1));
		}
		elseif($contador == 3){ 	// Condicion si el contador tiene como valor 3 , imprima lo siguiente.
			
				echo "Ha sacado trio" . "<br>";
				
				array_push($arraytrio,($i+1));
			}
		
		if($contador == 4){			// Condicion si el contador tiene como valor 4 , imprima lo siguiente.
			
			echo "Ha sacado poker" . "<br>";
			
			array_push($arraypoker,($i+1));
		}
		
		$contador=1;		// Cambiamos de nuevo su valor a 1.
		
		echo "<br>";
	}
	
	echo "=========== Premios ===========" . "<br>";
	
	/* Jugadores parejas */
	
	echo "--> Jugadores que sacaron parejas <--" . "<br>";
	
	for($i=0 ; $i < count($arraypareja) ; $i++){
		
		echo "Jugador $arraypareja[$i]" . "<br>";
	
	}
	
	echo "<b>No se reparte ningún premio</b>" . "<br><br>";
	
	/* Jugadores doble pareja */
	echo "--> Jugadores que sacaron doble parejas <--" . "<br>";
	
	$cantidad=count($arraydoble);
	
	if($cantidad==0)
		
		$cantidad=1;
	
	$bote=$b*0.5;
	
	$premio=$bote/$cantidad;
	
	for($i=0 ; $i < count($arraydoble) ; $i++){
		
		echo "Jugador $arraydoble[$i] , tiene como premio $premio" . "<br>";
	
	}
	
	echo "<b>Se reparte el 50% del bote entre el ganador/es</b>" . "<br><br>";
	
	/* Jugadores trio */
	
	echo "--> Jugadores que sacaron trio <--" . "<br>";
	
	$cantidad=count($arraytrio);
	
	if($cantidad==0)
		
		$cantidad=1;
	
	$bote=$b*0.7;
	
	$premio=$bote/$cantidad;
	
	for($i=0 ; $i < count($arraytrio) ; $i++){
		
		echo "Jugador $arraytrio[$i] , tiene como premio $premio" . "<br>";
	
	}
	
	echo "<b>Se reparte el 70% del bote entre el ganador/es</b>" . "<br><br>";
	
	/*Jugadores poker*/
	
	echo "--> Jugadores que sacaron poker <--" . "<br>";
	
	$cantidad=count($arraypoker);
	
	if($cantidad==0)
		
		$cantidad=1;
	
	$bote=$b;
	
	$premio=$bote/$cantidad;
	
	for($i=0 ; $i < count($arraypoker) ; $i++){
		
		echo "Jugador $arraypoker[$i] , tiene como premio $premio" . "<br>";
	
	}
	
	echo "<b>Se reparte el bote completo entre el ganador/es<b>" . "<br><br>";
	
};
// Funcion limpiar variables //
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>