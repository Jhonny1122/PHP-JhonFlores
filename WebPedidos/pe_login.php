<html>
	<head>
		<title>Login Pedidos</title>
	</head>
	<body>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h2>Login</h2>
			<label>Usuario</label>
			<input type="text" name="usuario"/><br><br>
			<label>Password</label>
			<input type="password" name="password"/><br><br>
			<input type="submit" name="submit" value="Enviar"/>
		</form>
	</body>
</html>

<?php

include("funciones.php");

if (isset($_POST["submit"])){
	
	$usuario= limpiar($_POST["usuario"]);
	
	$password= limpiar($_POST["password"]);
	
	login($usuario,$password,conexion());
	
}

?>