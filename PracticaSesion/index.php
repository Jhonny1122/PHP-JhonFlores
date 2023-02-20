<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Sesiones</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
		<form action="" method="POST">
			<fieldset>
				<h2>Login</h2>
				<label>Usuario:</label>
				<input type="text" name="usuario"/><br><br>
				<label>Password:</label>
				<input type="text" name="contrasena"/><br><br>
				<input type="submit" name="submit" value="Comprobar"/>
			</fieldset>
		</form>
  </body>
</html>

<?php
	//Llamamos a las funciones del fichero funciones.php
	include("funciones.php");

	//Si pulsamos submit hara lo siguiente.
	if(isset($_POST["submit"])){
		
		//Guarda las variables
		$usuario = $_POST["usuario"];
		
		$contrasena = $_POST["contrasena"];
		
		//Llama a la siguiente funcion, esta funcion le dirige al siguiente fichero si se loguea bien.
		get_login($usuario,$contrasena,conexion());
		
	}



?>