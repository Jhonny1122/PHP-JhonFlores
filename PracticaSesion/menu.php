<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu de Opciones</title>
  </head>
  <body>
		<?php
			//Reanudamos la sesion
			session_start();
			
			//Comprobamos que se ha logueado el usuario, sino se ha logueado le manda de nuevo al index.php
			if(!isset($_SESSION["usuario"])){
				
				header("location:index.php");
			}
		
		?>
		<form action="" method="POST">
			<h2>Menu de Opciones</h2>
			
			<a href="altapedidos.php">Alta Pedidos</a><br><br>
			<input type="submit" name="salir" value="Cerrar Sesion"/>
			
		</form>
  </body>
</html>

<?php
	//Llamamos a las funciones del fichero funciones.php
	include("funciones.php");

	//Si pulsa el boton salir o cerrar sesion , destruira la sesion por completo.
	if(isset($_POST["salir"])){
		
		destruir_sesion();
		
	}
?>