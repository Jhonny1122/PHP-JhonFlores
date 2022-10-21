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
	<label>Borrar Fichero</label><br><br>
	<input type="submit" name="submit" value="Ejecutar operacion"/>
	<input type="reset" name="reset" value="Borrar"/>
	</form>
</body>
</html>

<?php

if (isset($_POST["submit"])){
	
	$origen = $_POST["origen"];
	
	$destino = $_POST["destino"];
	
	
	
};

?>