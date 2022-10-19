<?php
/* Comprobamos que ha dado click en submit */
if (isset($_POST["submit"])){
	
	$nombre = limpiar($_POST["nombre"]);
	
	$apellido1 = limpiar($_POST["apellido1"]);
	
	$apellido2 = limpiar($_POST["apellido2"]);
	
	$email = limpiar($_POST["email"]);
	
	$sexo = limpiar($_POST["sexo"]);
	
	if ($nombre == "" || $email == "" || $sexo == ""){
		
		echo "Los campos Nombre , Email y Sexo son obligatorios.";
	}
	else {
		// Creamos y guardamos dentro de la variable "fichero", fopen = abrir o crear el archivo datos.txt  .
		$fichero = fopen ("datos.txt" , "a")  or die("Unable to open file!");
		// fwrite nos sirve para escribir , (nombre del fichero, Lo que queremos escribir en el archivo.
		fwrite($fichero, "Nombre:" . $nombre . "\n");
		
		fwrite($fichero, "Apellido1:" . $apellido1 . "\n");
		
		fwrite($fichero, "Apellido2:" . $apellido2 . "\n");
		
		fwrite($fichero, "Email:" . $email . "\n");
		
		fwrite($fichero, "Sexo:" . $sexo . "\n");
		
		fclose("datos.txt");
		
		$apellidos = $apellido1 . " " . $apellido2; 
		
		echo "<h1>Datos Alumnos</h1>";
		
		echo "<table border=1><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th>";
		
		echo "<tr><td>$nombre</td><td>$apellidos</td><td>$email</td><td>$sexo</td></tr>";
	}
}

// Zona de funciones
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>
