<?php

if (isset($_POST["submit"])){
	
	$decimal = limpiar($_POST["decimal"]);
	
	$binario = conversor($decimal);
	
	echo "<br>";
	
	echo "Numero Binario: " . $binario;
}

function conversor ($a){
	
	return decbin($a);
}

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}


?>

<html>
<head>
	<title>
	Conversor Binario
	</title>
</head>
<body>
	
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
