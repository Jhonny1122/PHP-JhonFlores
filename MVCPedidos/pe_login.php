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

	if(isset($_POST["submit"])){
		
		$usuario=$_POST["usuario"];
		
		$pass=$_POST["password"];
		
		echo "Inicio index"."<br>";
		// Llamada al fichero que inicia la conexión a la Base de Datos
		include_once("db/db.php");
		
		// Llamada al controlador
		require_once("controllers/control_login.php");
		echo "Fin index"."<br>";
	}

?>