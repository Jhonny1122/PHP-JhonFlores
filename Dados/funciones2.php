<?php
// Validar jugadores y agregarlos a un array //

function validarJugadores($j1,$j2,$j3,$j4,$a){
	
	if (is_null($j1)){
		
	}
	else{
		
		array_push($a,$j1);
	}
	
	if (is_null($j2)){
		
	}
	else{
		
		array_push($a,$j2);
	}
	
	if (is_null($j3)){
		
	}
	else{
		
		array_push($a,$j3);
	}
	
	if (is_null($j4)){
		
	}
	else{
		
		array_push($a,$j4);
	}
	
	$a = array_diff($a, array("",0,null));
	
	return $a;
	
}; 

// Funcion validar longitud de jugadores //

function validarLongitud($a){
	
	$correcto=false;
	
	if (count($a) < 2){
		
		echo "Se necesita al menos 2 personas para poder empezar el juego." . "<br>";
	}
	else{
		
		$correcto = true;
	}
	
	return $correcto;
};

// Funcion validara dados //

function validarDados($numdados){
	
	$correcto=false;
	
	if ($numdados < 1 || $numdados > 10){
		
		echo "El numero de dados tiene que ser mayor o igual a 1." . "<br>";
	}
	else{
		
		$correcto = true;
	}
	
	return $correcto;
};

// Funcion donde empieza el juego //
// Pasamos por parametro $correctoDados,$correctoJugadores,$arrayjugadores,$numdados,$dados //
function jugar($bien1,$bien2,$a,$numdados,$dados){
	//Creamos unas variables mas para almacenar algunos datos //
	$array1=array();
	
	$suma=0;
	
	$arraySuma=array();
	
	$jugador=0;
	
	if ($bien1 == true && $bien2 == true){	// Si es true las dos variables inicia el juego //
		
		echo "<h1>Resultado Juego Dados</h1>";
		
		echo "<table border=1>";
		
		for ($i = 0 ; $i < count($a) ; $i++){	// Bucle para recorrer los numeros de jugadores //
			
			echo "<tr><td>Jugador: $a[$i]</td>";
			
			for($j = 0 ; $j < $numdados ; $j++){	// Bucle para recorrer la cantidad de dados que pone //
				
				$numero=array_rand($dados);		// Sacamos aleatoriamente los numeros del array $dados
				
				$numero=($numero+1);			// Lo guardamos , pero sumando +1 a ese numero del array //
				
				echo "<td>$numero</td>";
				
				$array1[$j]=$numero;		// Almacenamos los dados en un array , este tendra la longitud dependiendo de las vueltas//

			};
			
			$a[$i] = $array1;		// Asiganamos el array al jugador //
			
			$esigual = count(array_unique($array1))===1;	// Linea donde comprueba si todos los elementos son repetidos //
			
			if ($esigual == true){		// Condicion , si son iguales cambia la variable a 100 //
				
				$suma=100;
				
				$arraySuma[$i]=$suma;
			}
			else{
				
				$suma= array_sum($array1);	// Sumamos el array y lo almacenamos en una variable //
				
				$arraySuma[$i]=$suma;
			}

			echo "Jugador " . ($i+1) . " = " .$suma . "<br>";
			
		};
		
		echo "</table>";
		
		return $arraySuma;
		
	}
	// Si alguno de las dos es falsa no se inicia y se manda mensaje //
	else{
		
		echo "Vuelve a introducir los datos, para poder empezar el juego.";
	}
	
};

// Funcion sacar ganador //
function ganador ($a){
	
	$mayor=0;
	
	$contador=0;
	
	for ($i = 0 ; $i < count($a) ; $i++){
		
		if ($a[$i] > $mayor){
			
			$mayor=$a[$i];
		}
		
	}
	
	for ($i = 0 ; $i < count($a) ; $i++){
		
		if ($a[$i] == $mayor){
			
			$contador++;
		}
	};
	
	if($contador >= 2 ){
		
		echo "Hay $contador ganadores";
	}
	
};

// Funcion limpiar datos //
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>
