<html>
<head>
	<title>Datos Alumnos</title>
</head>
<body>
	<h1>Datos Alumnos</h1>
	<!-- enctype nos sirve para encriptar la informacion,no es necesario ahora pero viene bien saberlo.  -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
		<label>Nombre: </label>
		<input type="text" name="nombre"/>
		<label>*Obligatorio</label>
		<br><br>
		<label>Apellido1: </label>
		<input type="text" name="apellido1"/><br><br>
		<label>Apellido2: </label>
		<input type="text" name="apellido2"/><br><br>
		<label>Email: </label>
		<input type="text" name="email"/>
		<label>*Obligatorio</label>
		<br><br>
		<label>Sexo: </label>
		<input type="radio" name="sexo" value="Hombre";
		<label>Hombre</label>
		<input type="radio" name="sexo" value="Mujer";
		<label>Mujer</label>
		<label>*Obligatorio</label>
		<br><br>
		<input type="submit" name="submit" value="Enviar"/>
		<input type="reset" name="reset" value="Borrar"/>
	</form>
</body>
</html>

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
		
		$apellidos = $apellido1 . " " . $apellido2; 
		
		echo "<h1>Datos Alumnos</h1>";
		
		echo "<table border=1><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Sexo</th>";
		
		echo "<tr><td>$nombre</td><td>$apellidos</td><td>$email</td><td>$sexo</td></tr>";
		
		// Creamos y guardamos dentro de la variable "fichero", fopen = abrir o crear el archivo datos.txt  .
		$fichero = fopen ("datos.txt" , "a");
		// fwrite nos sirve para escribir , (nombre del fichero, Lo que queremos escribir en el archivo.
		fwrite($fichero, "Nombre:" . $nombre . "\n");
		
		fwrite($fichero, "Apellido1:" . $apellido1 . "\n");
		
		fwrite($fichero, "Apellido2:" . $apellido2 . "\n");
		
		fwrite($fichero, "Email:" . $email . "\n");
		
		fwrite($fichero, "Sexo:" . $sexo . "\n");
		
		fwrite($fichero, "\n");
		
		/*
		// Este codigo nos muestra lo que contiene el fichero datos.txt
		Abrimos el fichero modo lectura.
		$fichero = fopen ("datos.txt" , "r");
		// feof es una funcion nos dice si hemos terminado con el fichero.
		while (!feof($fichero)){
			// fgets nos da la primera linea y despues salta a la siguiente.
			$linea = fgets($fichero);
			
			echo $linea . "<br>";
		}
		
		fclose($fichero);
		*/
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