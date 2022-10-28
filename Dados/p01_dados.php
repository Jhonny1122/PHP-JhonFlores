<?php

if (isset($_POST["tirar"])){
	// Zona de variables //
	$jug1 = $_POST["jug1"];
	
	$jug2 = $_POST["jug2"];
	
	$jug3 = $_POST["jug3"];
	
	$jug4 = $_POST["jug4"];
	
	$numdados = $_POST["numdados"];
	
	$jugadores = array();
	
	$dados = array("1","2","3","4","5","6");
	
	$validardados = false;
	
	$validarjug = false;
	
	// Llamamos a las funciones y asiganamos algunos valores //
	
	echo "<h1>RESULTADO JUEGO DE DADOS</h1>";
	
	$jugadores = agregarJug($jug1,$jug2,$jug3,$jug4,$jugadores);
	
	$validardados = controlDados($numdados);
	
	$validarjug = comprobarJug ($jugadores);
	
	jugar($validardados,$validarjug,$dados,$jugadores);
	
	
	
};

// Zona de funciones //
/*Funcion donde pasamos los nombres de los jugadores y los vamos agregando a un array.*/
function agregarJug($a,$b,$c,$d,$e){
	
	if (strlen($a) != 0){
		
		$e[0]=$a;
	}
	if (strlen($b) != 0){
	
		$e[1]=$b;
	}
	if (strlen($c) != 0){
		
		$e[2]=$c;
	}
	if (strlen($d) != 0){
		
		$e[3]=$d;
	}
	return $e;
};

/*Funcion donde pasamos los nombres de los jugadores y el array donde guardara esos nombres*/
function comprobarJug ($e){
		
	$correcto = false;
	
	if (count($e) < 2){
		
		echo "Debe de haber al menos 2 jugadores" . "<br>";
	}
	else{
		
		$correcto = true;
	}
		
		return $correcto;
};
/*Funcion donde comprobamos si el rango de numero de dados es correcto*/
function controlDados($a){
	
	$correcto = false;
	
	if ($a >=1 && $a <=10){
		
		$correcto=true;
	}
	else{
		
		echo "El numero de dados debe ser como minimo 1 y como maximo 10." . "<br>";
	}
	
	return $correcto;
	
};
/*Funcion donde empezamos con el juego si todo es correcto*/
function jugar ($a, $b , $c , $d){
	
	$juego=array();
	
	if ($a == true & $b == true){
		
		echo "<table border=1>"; 
		
		for ($i = 0 ; $i < count($d) ; $i++){
			
			$numero = array_rand($c);
			
			$juego[$d[$i]]=$numero;
		};
		
		foreach($juego as $x => $x_valor){
			
			echo "<tr><td>Jugadore : $x </td><td> Numero: $x_valor</td>" . "<br>";
		}
		
		echo "</table>";
	}
	else {
		
		echo "No podemos empezar el juego. Vuelve a introducir los valore." . "<br>";
	}
	
};

?>