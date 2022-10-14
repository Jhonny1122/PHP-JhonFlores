<html>
<head>
	<title>
	Conversor Binario
	</title>
</head>
<body>
	<!--En action hacemos que se llame asi mismo la pagina, para no cambiar de pagina -->
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
	
	<h1>Conversor Binario</h1>
	
	<label>Numero Decimal</label>
	
	<input type="text" name="decimal"/>
	
	<br/><br/>
	
	<input type="submit" value="Enviar" name="submit"/>
	
	<input type="reset" value="Borrar"/>
	
	</form>
</body>

</html>

<?php
// Condicion donde verfica que se ha dado click en submit, para no dar errores.
if (isset($_POST["submit"])){
	// Guardamos en la variable , lo que haya en decimal del html. Antes de guardarlo lo limpia.
	$decimal = limpiar($_POST["decimal"]);
	// Guardamos en la variable , lo que retorne la funcion conversor.
	$binario = conversor($decimal);
	
	echo "<br>";
	
	echo "Numero Binario: " . $binario;
}
// Funcion donde convierte a binario lo que pase por argumento.
function conversor ($a){
	
	return decbin($a);
}
// Funcion que se encarga de limpiar la variable pasada por argumento.
function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}


?>
