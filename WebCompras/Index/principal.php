<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='CSS/styloPrincipal.css' rel='stylesheet'>

    <title>Sesiones</title>
</head>
<body>
    <div class="contenedor">
        <div class="item1">
            <h2>Bienvenido a la cesta de la compra</h2>
        </div>
        <div class="item2">
            <h3>Registro</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <label>Nombre:</label>
                <input type="text" name="nombre" /><br><br>
                <label>Apellido:</label>
                <input type="text" name="apell" /><br><br>
                <label>nif:</label>
                <input type="text" name="nif" /><br><br>
                <input type="submit" name="submitRegistrar" value="Registrarse"/>
            </form>
        </div>
        <div class="item3">
            <h3>Login</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <label>Nombre:</label>
                <input type="text" name="usuario" /><br><br>
                <label>Clave:</label>
                <input type="password" name="clave" /><br><br>
                <input type="submit" name="submitLogin" value="Enviar"/>
            </form>
        </div>  
    </div>    
</body> 
</html>

<?php

include("funciones.php");

/*Recuerda:Condicion si el cliente da click en loguearse*
LLama a la funcion login y hace el proceso(Esto reemplaza al archivo php que indico el profe)*/
if (isset($_POST["submitRegistrar"])){
	
	$nombre = limpiar($_POST["nombre"]);
	
	$apell = limpiar($_POST["apell"]);
	
	$apellinv = strrev($apell);
	
	$nif = limpiar($_POST["nif"]);
	
	if (!empty($nif) && !empty($nombre) && !empty($apell)){
		
		registro($nombre,$apellinv,$nif,conexion());
		
		registro2($nombre,$apell,$nif,conexion());
	}
	else{
		
		echo "Error en los datos, rellenalos de nuevo.";
	}
	
}

/*Recuerda:Condicion si el cliente da click en loguearse*
LLama a la funcion login y hace el proceso(Esto reemplaza al archivo php que indico el profe)*/
if (isset($_POST["submitLogin"])){
	
	$usuario = limpiar($_POST["usuario"]);
	
	$clave = limpiar($_POST["clave"]);
	
	if (!empty($usuario) && !empty($clave)){
		/*Guardamos la cookie del nombre de usuario*/
		setcookie("nombre_cliente","$usuario",time()+30000);
		
		$nif_cliente=obtener_nif($usuario,$clave,conexion());
		
		setcookie("nif_cliente","$nif_cliente",time()+30000);
		
		login($usuario,$clave,conexion()); 
	}
	else{
		
		echo "Error , hay que rellenar los campos";
	}
}


?>