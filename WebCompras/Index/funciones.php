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

function registro ($nombre,$apellinv,$nick,$conn){
	
	$stmt = $conn->prepare('INSERT INTO REGISTRO (USUARIO , CLAVE , NICK ) VALUES (:nombre , :apellinv , :nick)');
	
	$stmt->bindParam(':nombre', $nombre);
	
	$stmt->bindParam(':apellinv', $apellinv);
	
	$stmt->bindParam(':nick', $nick);
			
	$stmt->execute();
	
};

function login ($usuario,$clave,$conn){
	
	$stmt = $conn->prepare('SELECT * FROM REGISTRO WHERE USUARIO=:usuario AND CLAVE=:clave');
	
	$stmt->bindParam(':usuario', $usuario);
	
	$stmt->bindParam(':clave', $clave);
			
	$stmt->execute();
	
	$num_registro=$stmt->rowCount();
	
	if($num_registro != 0){
		
		header("location:opciones.php");
	}
	else{
		
		header("location:principal.php");
	}
	
};


function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>