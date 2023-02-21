<html>
	<head>
		<title>Menu</title>
	</head>
	<body>
		<?php	
			session_start();
			
			if(!isset($_SESSION["usuario"])){
				
				header("location:pe_login.php");
			}
		?>
		<h2>
			<?php
				$usuario=$_SESSION["usuario"];
				
				echo "Bienvenido usuario " . $usuario ;
			?>
		</h2>
		<h2>Menu de Opciones</h2>
		<a href="pe_altaped.php">Alta Pedidos</a><br>
		<a href="pe_consped.php">Consulta Pedidos</a><br>
		<a href="pe_consprodstock.php">Consulta Producto Stock</a><br>
		<a href="pe_constock.php">Consulta Productos Stocks </a><br>
		<a href="pe_topprod.php">Consulta Ventas Productos</a><br>
		<a href="pe_conspago.php">Consulta Pagos</a><br><br>
	</body>
</html>