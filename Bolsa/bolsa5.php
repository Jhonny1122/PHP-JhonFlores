<html>
<head>
	<title>Ejercicio 5</title>
</head>
<body>
	<h1>Consulta Operaciones Bolsa</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<label>Mostrar</label>
		<select name="mostrar">
			<option>Selecciona una opcion</option>
			<option value="totalVolumen">Total Volumen</option>
			<option value="totalCapital">Total Capitalizacion</option>
		</select>
		<br><br>
		<input type="submit" name="submit" value="Visualizar"/>
		<input type="reset" name="reset" value="Borrar"/>
	</form>
</body>
<html>
<?php
include("funciones_bolsa.php");
if (isset($_POST["submit"])){
	$mostrar = limpiar($_POST["mostrar"]);
	echo mostrarTotal($mostrar);
};

?>