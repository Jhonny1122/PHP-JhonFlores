<html>
<head>
	<title>Fichero 7</title>
</head>
<body>
	<h1>Operaciones Sistemas Ficheros</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<label>Fichero Origen(Path/nombre): </label>
	<input type="text" name="origen"/><br><br>
	<label>Fichero Destino (Path/nombre): </label>
	<input type="text" name="destino"/><br><br>
	<label>Operaciones:</label><br>
	<input type="radio" name="operaciones" value="copiar"/>
	<label>Copiar Fichero</label><br>
	<input type="radio" name="operaciones" value="renombrar"/>
	<label>Renombrar Fichero</label><br>
	<input type="radio" name="operaciones" value="borrar"/>
	<label>Borrar Fichero/Directorio</label><br><br>
	<input type="submit" name="submit" value="Ejecutar operacion"/>
	<input type="reset" name="reset" value="Borrar"/>
	</form>
</body>
</html>

<?php

if (isset($_POST["submit"])){
	
	$origen = $_POST["origen"];
	
	$destino = $_POST["destino"];
	
	$operaciones = $_POST["operaciones"];
	
	$rutab = dirname($destino);
	
	$ficherob = basename($destino);
	
	$ficheroa = basename($origen);
	
	echo "<h1>Operaciones Sistemas Ficheros</h1>";
	
	echo verificarRutas($origen,$destino,$rutab,$ficherob,$ficheroa,$operaciones);
	
};
// Zona Funciones
function verificarRutas($Origen,$Destino,$RutaB,$FicheroB,$FicheroA,$Operaciones){
	
	if (file_exists($Origen)) {
		
		if (file_exists($Destino)) {
			
			echo "El fichero $Destino existe";
			
			echo "<br>";
			
			echo realizarOperacion ($Origen,$Destino,$RutaB,$FicheroB,$FicheroA,$Operaciones);
		} 
		else {
			
			echo "El fichero $Destino no existe." . "<br>";

			echo "Se ha creado el directorio $RutaB" . "<br>";
			
			echo realizarOperacion ($Origen,$Destino,$RutaB,$FicheroB,$FicheroA,$Operaciones);
		}	
	} 
	else {
		
		echo "El fichero $Origen no existe";
	}
	
	
};

function realizarOperacion ($Origen,$Destino,$RutaB,$FicheroB,$FicheroA,$Operaciones){
	
	if ($Operaciones == "copiar"){
		
		mkdir ($RutaB);
				
		chdir($RutaB);
					
		$fichero=fopen("$FicheroB","a");
					
		fclose($fichero);
					
		copy($Origen,$Destino);
					
		echo "Se ha copiado correctamente.";
	};
	
	if ($Operaciones == "renombrar"){
				
		rename($Origen,$Destino);
				
		echo "Se ha renombrado con exito de $FicheroA a $FicheroB .";
	};
			
	if ($Operaciones == "borrar"){
		
		if (is_dir($Destino)){
			
			rmdir($Destino);
			
			echo "Se ha eliminado correctamente el directorio $Destino.";
		};
		if (is_file($Destino)){
			
			unlink($Destino);
			
			echo "Se ha eliminado correctamente el fichero $FicheroB .";
		};
	};
	
	
};

?>
