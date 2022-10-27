<?php
//------------------- Funcion ejercicio 1 -------------------//
/*Funcion donde pasamos por parametro el fichero a buscar, y nos devuelve linea a linea su contenido.*/
function leerBolsa ($a){
	
	while (!feof($a)){
		
		$linea = fgets($a);
		
		echo $linea . "<br>";
	}
};

//------------------- Funcion ejercicio 2 -------------------//
/*Funcion que recibe como parametro el valor a buscar, y devuelve la linea donde se encuentra*/
function mostrarValor($a){	

	$lineas = file("ibex35.txt");	
	
	foreach ($lineas as $num_linea => $linea) {
		
		$primero = rtrim(substr($linea, 0, 23));

		if (rtrim($primero) == $a){
			
			echo $linea;
		};
	};
};

//------------------- Funcion ejercicio 3 -------------------//
/*Fucnion donde le pasamos por parametro el valor que ha elegido, y devuelve los rangos extraidos. En este caso son ultima cotizacion, maximo y minimo.
Explicacion: 
Con la funcion file guardamos lo que haya, en la variable lineas. 
Inciamos un bucle para leer el array asociativo.
Dentro del bucle creamos unas variables donde extraemos lo que haya dentro de un rango, recuerda que todo esto dentro de linea(son las columnas). Ademas quitamos los espacios con etrim.
Condicion donde el valor pasado por parametro es igual a la variable valor, si se cumple que nos muestre los echos.
*/
function mostrarUMM($a){	

	$lineas = file("ibex35.txt");	
	
	foreach ($lineas as $num_linea => $linea) {
		
		$valor = rtrim(substr($linea, 0, 23));
		
		$ultimo = rtrim(substr($linea, 23, 9));
		
		$maximo = rtrim(substr($linea, 60, 8));
		
		$minimo = rtrim(substr($linea, 69, 8));

		if (rtrim($valor) == $a){
			
			echo "Has escogido el valor : " . $valor . "<br>";
			
			echo "Ultima Cotizacion de " . $valor ." : " . $ultimo . "<br>";
			
			echo "Cotizacion Maxima de " . $valor ." : " . $maximo . "<br>";
			
			echo "Cotizacion Minima de " . $valor ." : " . $minimo . "<br>";
		};
	}
}

//------------------- Funcion ejercicio 4 -------------------//
/*Funcion donde pasamos por parametros a=valor y b=mostrar y nos devuelve lo que ha elegido. 
Explicacion:
Guardamos el contenido de ibex.txt en lineas.
Iniciamos un bucle para ver el contenido de ibex.txt.
Guardamos en sus respectivas variables los rangos que nos interesan.
Condiciones donde mostramos lo que haya elegido en "mostrar".
*/
function mostarOpcion($a,$b){
	
	$lineas = file("ibex35.txt");	
	
	foreach ($lineas as $num_linea => $linea) {
		
		$valor = rtrim(substr($linea, 0, 23));
		
		$ultimo = rtrim(substr($linea, 23, 9));
		
		$variacion1 = rtrim(substr($linea,32,8));
		
		$variacion2 = rtrim(substr($linea,40,8));
		
		$anual = rtrim(substr($linea,48,11));
		
		$maximo = rtrim(substr($linea, 60, 8));
		
		$minimo = rtrim(substr($linea, 69, 8));
		
		$volumen = rtrim(substr($linea, 78, 12));
		
		$capital = rtrim(substr($linea, 91, 8));
		
		$hora = rtrim(substr($linea, 100, 5));
		
		if (rtrim($valor) == $a){
			
			if($b == "ultimo"){
				
				echo "Ultima Cotizacion de " . $a . ": " . $ultimo;
			};
			if($b == "variacion1"){
				
				echo "Variacion % de " . $a . ": " . $variacion1;
			};
			if($b == "variacion2"){
				
				echo "Variacion de " . $a . ": " . $variacion2;
			};
			if($b == "anual"){
				
				echo "Ac%Anual de " . $a . ": " . $anual;
			};
			if($b == "maximo"){
				
				echo "Maximo de " . $a . ": " . $maximo;
			};
			if($b == "minimo"){
				
				echo "Minimo de " . $a . ": " . $minimo;
			};
			if($b == "volumen"){
				
				echo "Volumen de " . $a . ": " . $volumen;
			};
			if($b == "capital"){
				
				echo "Capital de " . $a . ": " . $capital;
			};
			if($b == "hora"){
				
				echo "Hora de " . $a . ": " . $hora;
			}
		};
	};
};

//------------------- Funcion ejercicio 5 -------------------//
/*Funcion donde pasamos por parametro la opcion que a elegido a mostrar
Explicacion:
Guardamos el contenido en lineas.
Creamos dos variables que son arrays, donde almacenaremos todos los datos que nos interesen.
Condiciones, mostramos lo que ha elegido.*/
function mostrarTotal($a){
	
	$lineas = file("ibex35.txt");
	
	$arrayVolumen=array();
	
	$arrayCapital =array();
	
	foreach ($lineas as $num_linea => $linea) {
		
		$arrayVolumen[$num_linea] = rtrim(substr($linea, 78, 12));
		
		$arrayCapital[$num_linea] = rtrim(substr($linea, 91, 8));
	};
	
	if ($a == "totalVolumen"){ // Esta condicion muestra en pantalla el array y lo suma.
		
		var_dump($arrayVolumen);
		
		echo array_sum($arrayVolumen);
	};
	if ($a == "totalCapital"){	// Esta condicion hace mas cosas, inciamos un bucle donde recorre una a una los valores.
		
		for ($i = 0 ; $i < count($arrayCapital) ; $i++ ){
			
			$numero = $arrayCapital[$i];	// Guarda en la variable numero, los valores.
			
			if (strlen($numero) <= 3){		// Si encuentra un valor con igual o menos digitos de 3 hara lo siguiente.
				
				$numero = doubleval($numero)/1000;	// Ese valor lo convierte en double, y lo divide entre 1000 para que no nos de el problema de la suma.
													// El problema de la suma es, me sumaba 482 en vez de 0.482 .Pienso que los puntos son miles.
				$arrayCapital[$i]=strval($numero);	// El valor lo cambiamos a string de nuevo y lo almacenamos en la posicion del valor que entro en el if.
			};	
		};
		
		var_dump($arrayCapital);
		
		echo array_sum($arrayCapital);
	};
};	

//------------------- Funcion ejercicio 6 -------------------//
function mostrarCVC(){
	
	
};	

//------------------- Funcion para depurar variables -------------------//
/*Funcion donde pasas las variables y los limpia de caracteres raros*/
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>