<html>
<head>
	<title>Ejercicio 6</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<h1>Consulta Operaciones Bolsa</h1>
		<h3>Acontinuacion te mostraremos: </h3>
		<ul>
			<li>El valor con la máxima cotización.</li>
			<li>El valor con la mínima cotización.</li>
			<li>El valor con el mayor volumen negociado.</li>
			<li>El de menor volumen.</li>
			<li>El de máxima capitalización.</li>
			<li>El de mínima capitalización.</li>
		</ul>
		<br>
		<input type="submit" name="submit" value="Mostrar"/>
	</form>
</body>
</html>
<?php
include("funciones_bolsa.php");
if (isset($_POST["submit"])){
	echo mostrarCVC();
};
?>