<html>
<head>
	<title>Fusion Cambio Base</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<h1>Conversor Numerico</h1>
	<label>Numero Decimal</label>
	<input type="text" name="decimal"/>
	<br/><br/>
	<label>Convertir a:</label></br>
	<input type="radio" name="base" value="2">
	<label> Binario </label><br>
	<input type="radio" name="base" value="8">
	<label> Octal </label><br>
	<input type="radio" name="base" value="6">
	<label> Hexadecimal </label><br>
	<input type="radio" name="base" value="todos">
	<label> Todos </label><br></br>
	<input type="submit" name="submit" value="Enviar"/>
	<input type="reset" value="Borrar"/>
	</form>
</body>
</html>

<?php

if (isset($_POST["submit"])){
	
	$decimal = limpiar($_POST["decimal"]);
	
	$base = limpiar($_POST["base"]);
	
	echo "<br>";

	echo "<br>";

	echo convertir ($decimal, $base);
}


function convertir(int $a , String $b){
	
	if ($b == 2){
		
		return "Numero Binario: " . decbin($a);
	}	 
	else if ($b == 8){
		
		return "Numero Octal: " . decoct($a);
	}
	else if ($b == 6){
		
		return "Numero Hexadecimal: " . dechex($a);
	}
	else if($b == "todos"){
		
		return "Numero Binario: " . decbin($a) . "<br>" .
			   "Numero Octal: " . decoct($a) . "<br>" .
			   "Numero Hexadecimal: " . dechex($a)
		;
	}
}

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>