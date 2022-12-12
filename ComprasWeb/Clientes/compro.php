<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Compra de Productos</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Compra de Productos</h2>
            <label>NIF:</label>
            <input type="text" name="nif_cl" maxlength="9"/><br><br>
			<label>Nombre:</label>
            <input type="text" name="nomb_cl"/><br><br>
			<label>Apellido:</label>
            <input type="text" name="apell_cl"/><br><br>
			<label>Codigo Postal:</label>
            <input type="text" name="cp_cl"/><br><br>
			<label>Direccion:</label>
            <input type="text" name="dirr_cl"/><br><br>
			<label>Ciudad:</label>
            <input type="text" name="ciud_cl"/><br><br>
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
	
	
}

?>