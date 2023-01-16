<!DOCTYPE html>
<?php

	if(isset($_COOKIE["nombre_cliente"])){
					
		$nombre_cliente=$_COOKIE["nombre_cliente"];
					
	}
	
	if(isset($_COOKIE["nif_cliente"])){
					
		$nif_cliente=$_COOKIE["nif_cliente"];
					
	}
	/*Creamos una cookie con valor 0 para posterior operacion*/
	setcookie("num_contador","0",time()+30000);
	
	setcookie("almacen"," ",time()+30000);
?>
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
            <h3>Bienvenido <?php echo $nombre_cliente ?> a tu cesta de la compra, nif <?php echo $nif_cliente ?></h3>
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