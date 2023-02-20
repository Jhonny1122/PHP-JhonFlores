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
			if(!isset($_COOKIE["usuario"])){
				
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
	include("funciones.php");

	if(isset($_POST["salir"])){
		
		destruir_cookie();
		
	}
?>