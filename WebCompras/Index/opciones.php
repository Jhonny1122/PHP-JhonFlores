<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='CSS/stylosOpc.css' rel='stylesheet'>
    <title>Opciones</title>
</head>
<body>
    <div class="contenedor">
        <div class="item1">
            <h3>Bienvenido 
			<?php
				
				if(isset($_COOKIE["cliente"])){
					
					echo $_COOKIE["cliente"];
				}else{
					
					echo "nada";
				}
			?>
				a tu cesta de la compra</h3>
            <p>Elige una opcion:</p>
        </div>
        <div class="item2">
            <a href="compras.php">Compra Productos</a>
        </div>
        <div class="item3">
            <a href="consulta.php">Consulta Productos</a>
        </div>
    </div>
</body>
</html>