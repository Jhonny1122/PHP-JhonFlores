<?php
//Recogida de valores
$dni=$_POST["dni"];
$nombre=$_POST["nombre"];
$salario=$_POST["salario"];
$fecha_nac=$_POST["fecha_nac"];
$cod_dpto=$_POST["cod_dpto"];

// Credenciales para conectar con la BBDD
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
	$stmt = $conn->prepare('INSERT INTO emple (dni,nombre,salario,fecha_nac,cod_dpto)
							VALUES (:cod_dpto,:nombre,:salario,:fecha_nac,:cod_dpto)');
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':nombre', $nombre);
	$stmt->bindParam(':salario', $salario);
	$stmt->bindParam(':fecha_nac', $fecha_nac);
	$stmt->bindParam(':cod_dpto', $cod_dpto);
	
	//$stmt->commit();
	$stmt->execute();
	//Ejecucion sentencia
	echo "Alta de Empleado correcta";
	
}
catch(PDOException $e)
{
	
	echo $e->getMessage() . "<br>";
	
    $error=$e->getCode();
	
	if ($error =="23000"){
		
		echo "Los datos del empleado son erroneos.";
	}
	else{
		
		echo "Error: " . $e->getMessage();
	}
}

$conn=null;

?>