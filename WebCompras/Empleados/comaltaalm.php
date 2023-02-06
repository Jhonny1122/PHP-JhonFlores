<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Alta Almacenes</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Alta Almacen</h2>
            <label>Localidad Almacen:</label>
            <input type="text" name="loc_alm"/><br><br><br>
            <input type="submit" name="submit"/>
        </form>
		<br><br><br>
		<a href="inicio.html">Inicio</a>
    </div>
</body>
</html>

<?php

	include("funciones.php");

	if (isset($_POST["submit"])){
		
		$loc_alm = limpiar ($_POST["loc_alm"]);
		
		if (empty($loc_alm)){
			
			echo "<h3><b>Error!!!!!!!!</b></h3>";
			
			echo "Necesitas rellenar los datos";
		}
		else {
			
			altaAlmacen($loc_alm,conexion());
		}
	}

?>