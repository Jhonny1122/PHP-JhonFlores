<html>
<head>
	<title>Fichero 5</title>
</head>
<body>
	<h1>Operaciones con Ficheros</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<label>Fichero(Path/nombre):</label>
	<input type="text" name="ruta" /><br><br>
	<label>Operaciones:</label><br>
	<input type="radio" name="operacion" value="fichero">
	<label> Mostar Fichero </label><br>
	<input type="radio" name="operacion" value="Linea">
	<label> Mostar linea 
		<input type="text" name="numLinea" size=2 maxlength=2/>
			del fichero
	</label><br>
	<input type="radio" name="operacion" value="CantidadLineas">
	<label> Mostar 
		<input type="text" name="numCantidadLinea" size=2 maxlength=2/>
			primeras lineas
	</label><br><br>
	<input type="submit" value="Enviar"/>
	<input type="reset" value="Borrar"/>
	</form>
</body>
</html>

<?php

if (isset($_POST["submit"])){
	
	echo "<h1>Si funciona esta parte </h1>";
	
	$fichero = $_POST["fichero"];
  
	if (file_exists($fichero)) {
		
		echo "El archivo exites";
	} 
	else {
		echo "El archivo no existe.";
	}
};

?>