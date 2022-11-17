<?php
/*Funcion para crear array de jugadores*/
function jugadores ($nomb1,$nomb2,$nomb3,$nomb4,$a){
	
	if (is_null($nomb1) == false){
	
		array_push($a,$nomb1);
	}
	
	if (is_null($nomb2) == false){
	
		array_push($a,$nomb2);
	}
	
	if (is_null($nomb3) == false){
	
		array_push($a,$nomb3);
	}
	
	if (is_null($nomb4) == false){
	
		array_push($a,$nomb4);
	}
	
	$a = array_diff($a, array("",0,null));
	
	return $a;
	
};

/*Funcion validar numero de jugadores*/
function validarNumJugadores($a){
	
	$correcto=true;
	
	if(count($a) < 4){
		
		echo "El numero de jugadores es incorrecto" . "<br>";
	}
	else {
		
		return $correcto;
	}
	
};

/*Repartir cartas a cada jugador y guardamos en sus arrays las cifras que debemos sumar*/
function repartirCartas($a,$b,$bien1,$numcartas){
	
	if($bien1 == true){		// Si es correcto los jugadores se podra empezar el juego.
		/*Zona de variables*/
		$array1=array();	
		
		$contador=0;
		
		echo "<h1>Juego de 7 y medio</h1>";
		
		echo "<table border=1>";
		
		for ($i = 0 ; $i < count($a) ; $i++){		// Bucle pàra recorrer los juagdores.
			
			echo "<tr><td>Jugador " . ($i+1) . " : $a[$i]</td>";	// Imprimimos los juagdores , y creamos la tabla.
			
			for ($j = 0 ; $j < $numcartas ; $j++){		// Bucle , dependiendo del numero de cartas introducidos , dara esas vueltas para asignar las cartas.
				
				$pos=shuffle($b); // Cogemos una posicion aleatoria del array $b(baraja) y lo guardamos en pos.
				
				$pos=$b[$j];	// Asiganmos a pos , el valor de la posicion sacada anteriormente.
				
				echo "<td>Carta " . ($j+1) . " : $pos</td>";
				
				$pos=substr($pos,0,1);		// Asiganmos a pos , la primera letra del valor.
				
				if($pos == "C" || $pos == "R" || $pos == "S"){		// Condicion, si la letra obtenida es igual a C , R o S , que cambie su valor a 0.5 .
					
					$pos=0.5;
				}
				
				$array1[$j]=doubleval($pos);	// Para poder sumar bien los elementos, hacemos un casting a double.
			}
			
			$a[$i]=$array1;		// Asiganamos a cada jugador su array.
			
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

/*Funcion donde mostramos la suma de los jugadores y comprobamos los ganadores */
function ganadores($cartas,$numcartas,$apuesta){
	/*Zona de variables*/
	$bote=0;
	
	$suma=0;
	
	$arrayDescalificados=array();
	
	$arrayNoDescalificados=array();
	
	$arrayGanador=array();
	
	$fichero = fopen ("apuestas.txt" , "a")  or die("Unable to open file!");
	
	for($i = 0 ; $i < count($cartas) ; $i++){		// Bucle donde recorremos los jugadores.
		
		fwrite($fichero,"Jugador = " . ($i+1) . "****");
	
		echo "Jugador " . ($i+1) . " :" . "<br>";	// Imprimos los jugadores.
		
		for($j = 0 ; $j < $numcartas ; $j++){		// Bucle donde recorremos las cartas de cada jugador.
			
			$suma+=$cartas[$i][$j];					// Sumamos las cartas.
		}
		
		fwrite($fichero,"Puntuacion = " . $suma . "****");
		
		fwrite($fichero, "\n");
		
		echo "Ha obtenido una puntuacion de " . $suma . "<br>";		// Imprimos puntuacion de cada jugador(La suma total de sus cartas).
		
		if($suma > 7.5){							// Condicion donde vamos separando los jugadores , comparamos sus puntuaciones(sumas).
			
			array_push($arrayDescalificados,($i+1));	// En caso de que sea mayor a 7.5 , lo guardamos en el siguiente array.
		}
		else{
			
			if($suma == 7.5){					// Condicion si la puntuacion(suma) es igual a 7.5 , lo guardamos en el siguiente array.
				
				array_push($arrayGanador,($i+1));	// Se guarda en este array.
			}
			else{
				
				array_push($arrayNoDescalificados,($i+1));	// Si la puntuacion es menor que 7.5 pero no es 7.5, se guarda en este array(Suma comprendida entre 0-7.4).
			}
			
		}
		
		$suma=0;				// Restablecemos a 0 la variable suma.
	}
	
	if(count($arrayGanador) >= 1){		// Condicion si hay algun elemento en arrayganador, haga lo siguiente.
		
		$premio=$apuesta/count($arrayGanador);	// En la variable premio se almacena, la division entre apuesta y la cantidad de jugadores que haya en el array.
		
		echo "<br>";
	
		echo "<b>Jugadores Ganadores</b>" . "<br>";		// Imprimimos el mensaje.
		
		echo "se reparte el 100% del importe jugado" . "<br>";
		
		for($i=0 ; $i < count($arrayGanador) ; $i++){	// Bucle para recorrer el array e imprimir el mensaje.
			
			echo "Jugador $arrayGanador[$i] tiene de premio $premio" . "<br>";
		
		}
		
		echo "<br>";
	}
	else{			// Si en caso no haya nada en el arrayGanador , hara lo siguiente.
		
		$apuesta=$apuesta*0.5;		// Guarda en apuesta la multiplicacion entre apuesta y 0.5 (Nos sirve para sacar la mitad del premio).
		
		$cantidad=count($arrayNoDescalificados);	// La cantidad de jugadores que haya en el arrayNoDescalificados.
		
		if($cantidad==0)	// En caso de que en cantida no haya nada, cambiamos el valor a 1 para que no de error.
		
			$cantidad=1;
		
		$premio=$apuesta/$cantidad;		// La cantidad a repartir dependiendo de los jugadores que haya en el arrayNoDescalificados.
		
		echo "<br>";
	
		echo "<b>Jugadores No Descalificados</b>" . "<br>";		// Imprimimos mensajes.
		
		echo "Se repartirá un 50% del importe jugado, a partes iguales, entre los ganadores de cada ronda." . "<br>";
		
		for($i=0 ; $i < count($arrayNoDescalificados) ; $i++){		// Bucle para recorrer el array e imprimir el mensaje.
			
			echo "Jugador $arrayNoDescalificados[$i] tiene de premio $premio" . "<br>";
		
		}
		
		echo "<br>";
	}
	
	echo "<b>Jugadores Descalificados</b>" . "<br>";		// Imprimir mensajes.
	
	for($i=0 ; $i < count($arrayDescalificados) ; $i++){
		
		echo "Jugador $arrayDescalificados[$i] no obtiene premio" . "<br>";
	
	}
	
	echo "<br>";
	
	if(count($arrayDescalificados) == 4 ){		// Condicion donde no hay ganadores.
		
		echo "No ha habido ninguna ganador, asi que el premio se guarda en el bote.";
		
		$bote+=$apuesta;
	}
	
	fwrite($fichero, "\n");
	
	fclose($fichero);
	
};

/* Funcion para limpiar las variables */
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>