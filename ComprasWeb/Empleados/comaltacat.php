<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Alta Categorias</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Alta Categorias</h2>
            <label>Nombre Categoria:</label>
            <input type="text" name="nomb_categ"/><br><br><br>
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
	
	$nomb_categ = limpiar($_POST["nomb_categ"]);
	
	if (empty($nomb_categ)){
		
		echo "El nombre de la categoria no puede estar vacio";
	}
	else{
		
		$numero=contarCat();
	
		altaCategoria($nomb_categ,$numero,conexion());
	}
	
}

?>