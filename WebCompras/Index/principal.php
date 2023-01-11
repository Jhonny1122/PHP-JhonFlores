<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/styloPrincipal.css" rel="stylesheet" type="text/css"/>
    <title>Document</title>
</head>
<body>
    <div class="registro">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Registro Usuario</h2>
			<label>Nombre:</label>
			<input type="text" name="nombre" /><br><br>
			<label>Apellido:</label>
			<input type="text" name="apell" /><br><br>
			<label>Nick:</label>
			<input type="text" name="nick" /><br><br>
			<input type="submit" name="submitRegistrar" value="Registrarse"/>
        </form>
    </div>
    <div class="login">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h2>Login Usuario</h2>
			<label>Usuario:</label>
			<input type="text" name="usuario" /><br><br>
			<label>Clave:</label>
			<input type="password" name="clave" /><br><br>
			<input type="submit" name="submitLogin" value="Enviar"/>
		</form>
    </div>
</body>
</html>

<?php

include("funciones.php");
/*Recuerda:Condicion si el cliente da click en loguearse*
LLama a la funcion login y hace el proceso(Esto reemplaza al archivo php que indico el profe)*/
if (isset($_POST["submitLogin"])){
	
	$usuario = limpiar($_POST["usuario"]);
	
	$clave = limpiar($_POST["clave"]);
	
	if (!empty($usuario) && !empty($clave)){
		
		login($usuario,$clave,conexion());
	}
	else{
		
		echo "Error , hay que rellenar los campos";
	}
}

/*Recuerda:Condicion si el cliente da click en loguearse*
LLama a la funcion login y hace el proceso(Esto reemplaza al archivo php que indico el profe)*/
if (isset($_POST["submitRegistrar"])){
	
	$nombre = limpiar($_POST["nombre"]);
	
	$apell = limpiar($_POST["apell"]);
	
	$apellinv = strrev($apell);
	
	$nick = limpiar($_POST["nick"]);
	
	if (!empty($nick) && !empty($nombre) && !empty($apell)){
		
		registro($nombre,$apellinv,$nick,conexion());
	}
	else{
		
		echo "Error en los datos, rellenalos de nuevo.";
	}
	
}


?>