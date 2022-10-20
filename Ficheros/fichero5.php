<html>
<head>
	<title>Fichero 5</title>
</head>
<body>
	<h1>Operaciones con Ficheros</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
	<label>Fichero(Path/nombre):</label>
	<input type="text" name="ruta" /><br><br>
	<label>Operaciones:</label><br>
	<input type="radio" name="operacion" value="fichero">
	<label> Mostar Fichero </label><br>
	<input type="radio" name="operacion" value="linea">
	<label> Mostar linea 
		<input type="text" name="numLinea" size=2 maxlength=2/>
			del fichero
	</label><br>
	<input type="radio" name="operacion" value="cantidadLineas">
	<label> Mostar 
		<input type="text" name="numCantidadLinea" size=2 maxlength=2/>
			primeras lineas
	</label><br><br>
	<input type="submit" name="submit" value="Enviar"/>
	<input type="reset" name="reset" value="Borrar"/>
	</form>
</body>
</html>

<?php
// Condicion ,donde se ejecuta cuando hace click.
if (isset($_POST["submit"])){
	// Zona de variables.
	$contador = 0;
	
	$contador2 = 0;
	
	$ruta = limpiar($_POST["ruta"]);
	
	$operacion = limpiar ($_POST["operacion"]);
	
	$numLinea = limpiar ($_POST["numLinea"]);
	
	$numCantidadLinea = limpiar ($_POST["numCantidadLinea"]);
	// Lo que vamos a mostrar debajo.
	echo "<h1>Operaciones Ficheros</h1>";
	// Condicion, donde comprobamos que existe el fichero.
	if (file_exists($ruta)) {
		// Abrimos el fichero
		$fichero = fopen ("$ruta","r");
		// Condicion, donde vemos que valor tiene el name operacion del html.
		if($operacion == "fichero"){
			// Este bucle da vueltas hasta que sea el fin del fichero.
			while (!feof($fichero)){
				// Guardamos lo que lea en cada linea.
				$linea = fgets($fichero);
				// Imprimimos lo que va guardando.
				echo $linea ;
			}
		}
		else if ($operacion == "linea"){
			
			while (!feof($fichero)){
				// El contador nos ayuda para saber en que vuelta esta, y tambien que linea.
				$contador++;
				
				$linea = fgets($fichero);
				// Condicion, donde el contador es igual al numero de linea indicado en esta opcion.
				if ($contador == $numLinea){
				
					echo $linea ;
				}
			}
		}
		else if ($operacion == "cantidadLineas"){
			
			while (!feof($fichero)){
				
				$contador2++;
				
				$linea = fgets($fichero);
				// Condicion, donde el contador es mayor o igual al numero de linea indicado en esta opcion.
				// Y desde ahi empieza a imprimir.
				if ($contador2 >= $numCantidadLinea){
				
					echo $linea . "<br>";
				}
			}
		}
	} 
	else {
		
		echo "El archivo indicado no existe.";
		
	}
	
	
};

// Zona Funciones

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>
