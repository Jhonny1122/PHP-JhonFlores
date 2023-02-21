<?php
	
	//*****************  Funcion Conexion  *****************//
	
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
	
	
	//*****************  Funcion Obtener Login  *****************//

	function get_login($usuario,$contrasena,$conn){
		
		$stmt = $conn->prepare('SELECT * FROM Customers WHERE CustomerNumber=:usuario AND ContactLastName=:contrasena');
	
		$stmt->bindParam(':usuario', $usuario);
		
		$stmt->bindParam(':contrasena', $contrasena);
				
		$stmt->execute();
		
		$num_registro=$stmt->rowCount();
		
		if($num_registro != 0){

			session_start();

			$_SESSION["usuario"]=$_POST["usuario"];

			header("location:menu.php");
		}
		else{

			header("location:index.php");
		}
		
	};

	
	//*****************  Funcion Destruir por completo Session  *****************//
	
	function destruir_sesion(){
		
		session_start();
		
		$params = session_get_cookie_params();
		
		setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
		
		//session_destroy();
		
		header("location:index.php");
	};
	
	
	//*****************  Funcion Obtener Precio  *****************//

	function get_precio($id_producto,$conn){
		
		$stmt = $conn->prepare("SELECT BuyPrice FROM Products WHERE ProductCode=:productcode");
					
		$stmt-> bindParam(":productcode",$id_producto);
		
		$stmt->execute();
					
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		$resultado=$stmt->fetchAll();
					
		foreach($resultado as $row) {
						
			$precio=$row["BuyPrice"];
		}
		
		return $precio;
		
	};
	
	
	//*****************  Funcion Generar Order Number  *****************//

	function max_orderNumber($conn){
		
		$stmt = $conn->prepare("SELECT MAX(OrderNumber) AS MAXIMO FROM Orders");
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$maximo=$row["MAXIMO"];
		};
		
		$maximo=$maximo+1;
		
		return $maximo;
		
	};





















?>