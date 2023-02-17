<html>
	<head>
		<title>Menu</title>
	</head>
	<body>
		<?php	
			session_start();
			
			if(!isset($_SESSION["usuario"])){
				
				header("location:pe_index.php");
			}
		?>
		<h2>Menu de Opciones</h2>
		<a href="controllers/altaped_controllers.php">Alta Pedidos</a><br>
		<a href="pe_consped.php">Consulta Pedidos</a><br>
		<a href="pe_consprodstock.php">Consulta Producto Stock</a><br>
		<a href="pe_constock.php">Consulta Productos Stocks </a><br>
		<a href="pe_topprod.php">Consulta Ventas Productos</a><br>
		<a href="pe_conspago.php">Consulta Pagos</a><br>
	</body>
</html>
