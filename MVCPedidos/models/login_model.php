<?php
	echo "Inicio modelo"."<br>";
	/*Funcion comprobar login, busca en la BBDD si existe ese usuario y contraseña*/
	function login ($usuario,$pass){
		
		global $conn;
		
		try{
			
			$stmt = $conn->prepare('SELECT * FROM Customers WHERE CustomerNumber=:usuario AND ContactLastName=:password');
	
			$stmt->bindParam(':usuario', $usuario);
			
			$stmt->bindParam(':password', $pass);
					
			$stmt->execute();
			
			$num_registro=$stmt->rowCount();
			
			return $num_registro;
			
		}
		catch(PDOException $ex){
			
			echo "Error al recuperar peliculas". $ex->getMessage();
			
			return null;
		}
		
	};
	
	echo "Fin modelo"."<br>";

?>