<html>
	<head>
		<title>Alta departamento</title>
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h1>Alta Dpartamento</h1>
			<label>Nombre Departamento</label>
			<input type="text" name="nombre" /><br><br>
			<input type="submit" name="submit" value="Enviar"/>
		</form>
	</body>
</html>

<?php

include("funciones.php");

if (isset($_POST["submit"])){
	
	$nombre = limpiar($_POST["nombre"]);
	
	altadpto($nombre);
	
};

?>