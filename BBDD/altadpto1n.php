<?php

// Recogida de datos
$cod_dpto=$_POST["dpto"];
$nombre=$_POST["nombre"];

// Credenciales conexion BBDD
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";


//PDO PHP Database Object
try{
	
	//Establecimineto conexion
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//Preparacionsentencia SQL
	$stmt = $conn->prepare('INSERT INTO dpto (cod_dpto,nombre)
							VALUES (:cod_dpto,:nombre)');
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':nombre', $nombre);
	
	//$stmt->commit();
	$stmt->execute();
	//Ejecucion sentencia
	echo "Alta Departamento correcta";
	
}
catch(PDOException $e)
{
	$errorCod_dpto=$e->getCode();
	
	if($errorCod_dpto == "23000"){
		
		echo "El codigo de departamento ya existe.";
	}
}

$conn=null;

?>