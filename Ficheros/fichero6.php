<html>
<head>
	<title>Fichero 6</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
		<center>
		<h1>Operaciones Ficheros</h1>
		<label>Fichero(Path/Nombre): </label>
		<input type="text" name="fichero"/>
		<br><br>
		<input type="submit" name="submit" value="Ver Datos Ficheros"/>
		<input type="reset" name="reset" value="borrar"/>
		</center>
	</form>
</body>
</html>
<?php

if (isset($_POST["submit"])){
	
	$fichero = $_POST["fichero"] ;
	
	$nomFichero = obtenerFichero ($fichero);
	
	if (file_exists($fichero)) {
		
		echo "Existe el fichero: " . $fichero;
		
		echo "<h2>Operaciones Ficheros</h2>";

		echo "<b>Nombre del Fichero: </b>" . obtenerFichero ($fichero);

		echo "<br>";
		
		echo "<b>Directorio: </b>" . getcwd ();

		echo "<br>";
		
		echo "<b>Tamaño del Fichero: </b>" . filesize($nomFichero) . " bytes";

		echo "<br>";
		
		echo "<b>Fecha Ultima Modificacion del Fichero: </b>" . date("F d Y H:i:s.", filemtime($nomFichero));

		echo "<br>";
	}
	else {
		
		echo "No existe el fichero";
	}
};

function obtenerFichero ($a){
	// Obtenemos el directorio donde estamso
    $directorio = getcwd ();
	// Obtenemos la longitud de un string.
	$longitudDirc = strlen($directorio);
	// Devuelve parte de una cadena, en este caso a partir de la posicion indicada.
	$fichero = substr($a,($longitudDirc+1));
	// Devuelve lo que queda del string
	return $fichero;
}

// En este caso no usamos esta funcion.
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>
