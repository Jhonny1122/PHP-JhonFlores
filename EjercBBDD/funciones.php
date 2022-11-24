<?php

function altadpto($nombre){
	
	if(empty($nombre)){
		
		echo "Es obligatorio introducir un nombre para el departamento.";
		
	}
	else{
		
		$servername = "localhost";
		$username = "root";
		$password = "rootroot";
		$dbname = "empleadosnn";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("INSERT INTO dpto (nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre", $nombre);
			if ($stmt->execute()) {
			  echo "Departamento añadido con exito." . "</br>";
			} else {
			  echo "No se puedo añadir el departamento." . "</br>";
		}
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
};

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>