<?php

if (isset($_POST["submit"])){
	
	$nombre = limpiar($_POST["nombre"]);
	
	$apellido1 = limpiar($_POST["apellido1"]);
	
	$apellido2 = limpiar($_POST["apellido2"]);
	
	$fechaNacimiento = limpiar($_POST["fechaNacimiento"]);
	
	$localidad = limpiar($_POST["localidad"]);
	
	$fichero = fopen ("alumnos2.txt" , "a")  or die("Unable to open file!");
	
	fwrite($fichero, str_pad($nombre,39,"#"));
	
	fwrite($fichero, str_pad($apellido1,40,"#"));
	
	fwrite($fichero, str_pad($apellido2,41,"#"));
	
	fwrite($fichero, str_pad($fechaNacimiento,9,"#"));
	
	fwrite($fichero, str_pad($localidad,26,"#"));
	
	fwrite($fichero, "\n");
	
	echo "<h1>Datos Alumno</h1>";
	
	echo "Los datos han sido guardados correctamente en el fichero alumnos2.txt" . "<br>" . "<br>";
	
};


// Zona Funciones

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}


?>