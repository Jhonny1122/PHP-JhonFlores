<?php
	/* Funcion conexion con la base de datos, devuelve una conexion*/
	function conexion (){
			
		$servername = "localhost";
				
		$username = "root";
				
		$password = "rootroot";
				
		$dbname = "pedidos";
				
		try {
					
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		}
		catch(PDOException $e) {
					
			echo "Error: " . $e->getMessage();
		}
				
		return $conn; 	
	};
	/*Funcion comprobar login, busca en la BBDD si existe ese usuario y contraseña*/
	function login ($usuario, $password , $conn){
		
		$stmt = $conn->prepare('SELECT * FROM Customers WHERE CustomerNumber=:usuario AND ContactLastName=:password');
	
		$stmt->bindParam(':usuario', $usuario);
		
		$stmt->bindParam(':password', $password);
				
		$stmt->execute();
		
		$num_registro=$stmt->rowCount();
		
		if($num_registro != 0){
			//Iniciamos sesion o reanudamos.
			session_start();
			//Guardamos en la variable super global sesion con nombre 'usuario' el valor de usuario.
			$_SESSION["usuario"]=$_POST["usuario"];
			//Redirigimos hacia ese fichero.
			header("location:pe_inicio.php");
		}
		else{
			//Redirige hacia la pagina login.
			header("location:pe_login.php");
		}
		
		
	};
	/*Funcion consulta stock del producto indicado.*/
	function consultaStock ($id_prod,$conn){
		
		$stmt = $conn->prepare("SELECT quantityInStock FROM products WHERE productCode=:id_prod");
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$cant_stock=$row["quantityInStock"];
		};
		
		echo "Hay en el stock " . $cant_stock . " .";
		
	};

	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};




?>