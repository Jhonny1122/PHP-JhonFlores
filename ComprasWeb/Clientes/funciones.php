<?php

	function conexion (){
		
		    $servername = "localhost";
			
			$username = "root";
			
			$password = "rootroot";
			
			$dbname = "comprasweb";
			
			try {
				
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			}
			catch(PDOException $e) {
				
				echo "Error: " . $e->getMessage();
			}
			
			return $conn; 	
	};
	
	function validar_dni($nif){
		
		$letra = substr($nif, -1);
		
		$numeros = substr($nif, 0, 8);
		
		if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8 ){

			return true;
		}else{

			return false;
		}
	};
	
	function alta_Cliente($nif,$nomb_cl,$apell_cl,$cp_cl,$dirr_cl,$ciud_cl,$conn){
		
		$nif_repe=false;
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		$stmt = $conn->prepare("SELECT NIF FROM CLIENTE");
		
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach($stmt->fetchAll() as $row) {
		
			if($nif == $row["NIF"]){
				
				$nif_repe=true;
			}
		}
		
		if($nif_repe==true){
			
			echo "NIF <b>Registrado</b>. Introduzca otro NIF";
		}
		else{
			
			$stmt = $conn->prepare("INSERT INTO CLIENTE (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) VALUES (:nif,:nomb_cl,:apell_cl,:cp_cl,:dirr_cl,:ciud_cl)");
		
			$stmt-> bindParam(":nif",$nif);
			
			$stmt-> bindParam(":nomb_cl",$nomb_cl);
			
			$stmt-> bindParam(":apell_cl",$apell_cl);
			
			$stmt-> bindParam(":cp_cl",$cp_cl);
			
			$stmt-> bindParam(":dirr_cl",$dirr_cl);
			
			$stmt-> bindParam(":ciud_cl",$ciud_cl);
			
			$stmt->execute();
			
			$stmt = $conn->prepare("SELECT * FROM CLIENTE WHERE NOMBRE=:nomb_cl");
			
			$stmt-> bindParam(":nomb_cl",$nomb_cl);
			
			$stmt->execute();
			
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach($stmt->fetchAll() as $row) {
			
				echo "NIF: " . $row["NIF"] . "<br>";
				
				echo "Nombre: " . $row["NOMBRE"] . "<br>";
				
				echo "Apellido: " . $row["APELLIDO"] . "<br>";
				
				echo "Codigo Postal: " . $row["CP"] . "<br>";
				
				echo "Direccion: " . $row["DIRECCION"] . "<br>";
				
				echo "Ciudad: " . $row["CIUDAD"] . "<br>";
			}
		}		
		
		$conn = null;
		
	};
	
	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};
	
?>