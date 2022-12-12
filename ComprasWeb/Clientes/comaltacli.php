<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/stylosprog.css">
    <title>Alta Cliente</title>
</head>
<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Alta Cliente</h2>
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
	
	$nif= limpiar ($_POST["nif_cl"]);
	
	$nomb_cl = limpiar ($_POST["nomb_cl"]);
	
	$apell_cl = limpiar ($_POST["apell_cl"]);
	
	$cp_cl = limpiar ($_POST["cp_cl"]);
	
	$dirr_cl = limpiar ($_POST["dirr_cl"]);
	
	$ciud_cl = limpiar ($_POST["ciud_cl"]);
	
	$nif_val=validar_dni($nif);
	
	if(empty($nif) || empty($nomb_cl) || empty($apell_cl) || empty($cp_cl) || empty($dirr_cl) || empty($ciud_cl)){
		
		echo "<b>ERROR!!!!!</b>" . "<br>";
		
		echo "Necesario rellenar todos los campos" . "<br>";
	}
	else{
		
		if($nif_val == true){
		
			alta_Cliente($nif,$nomb_cl,$apell_cl,$cp_cl,$dirr_cl,$ciud_cl,conexion());
		}
		else{
			
			echo "<b>ERROR!!!!!</b>" . "<br>";
			
			echo "NIF no valido, vuelve a introducir el dato." . "<br>";
		}
		
	}
	
}

?>