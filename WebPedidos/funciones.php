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
	
	function consultas_ejer3($id_cliente, $conn){
		/*Mostrar OrderNumber , OrderDate y Status de la tabla Orders , usando el id del cliente para filtrar.*/
		
		echo "========== Order ==========";
		
		echo "<br>";
		
		$contador=1;
		
		$array_orderNumber=array();
		
		$stmt = $conn->prepare("select OrderNumber, OrderDate , Status from orders where customerNumber=:id_cliente");
		
		$stmt-> bindParam(":id_cliente",$id_cliente);
	
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$orderNumber=$row["OrderNumber"];
			
			array_push($array_orderNumber,$row["OrderNumber"]);
			
			$orderDate=$row["OrderDate"];
			
			$status=$row["Status"];
			
			echo "<b>Orden " . $contador . "</b><br>";
			
			echo "OrderNumber: " . $orderNumber .  "<br>";
			
			echo "OrderDate: " . $orderDate .  "<br>";
			
			echo "Status: " . $status .  "<br><br>";
			
			$contador++;
		};
		
		echo "<br><br>";
		
		//var_dump($array_orderNumber);
	
		/*Mostrar OrderLineNumber, Productname , QuantityOrdered y PriceEach de las tablas Orderdetails y Products , usando el OrderNumber para filtar . Ademas mostrarlos ordenado segun el OrderLineNumber.*/
		echo "========== OrderDetails ==========";
		
		echo "<br>";
		//Bucle donde da una serie de vueltas segun la longitud del array.
		for ($i = 0 ; $i < count($array_orderNumber) ; $i++){
			//Consulta de los 4 datos que necesitamos segun el filtro/parametro indicado(En este caso recorrera cada elementos del array).
			$stmt = $conn->prepare("SELECT OrderLineNumber , PriceEach , QuantityOrdered , ProductCode from OrderDetails WHERE OrderNumber=:ordernumber ORDER BY OrderLineNumber ASC");
			//El valor ira cambiando segun en la posicion que este($array_orderNumber[$i]).
			$stmt-> bindParam(":ordernumber",$array_orderNumber[$i]);
		
			$stmt->execute();
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$resultado=$stmt->fetchAll();
			//Bucle para ir guardando ciertos valores en cada variable.
			foreach($resultado as $row) {
			
				$orderLineNumber=$row["OrderLineNumber"];
				
				$priceEach=$row["PriceEach"];
				
				$quantityOrdered=$row["QuantityOrdered"];
				//Guardamos el productcode importante para poder obe¡tner el nombre del producto.
				$productCode=$row["ProductCode"];
					//Consulta del dato que necesitamos segun el filtro/parametro que le indicamos(En este caso como esta dentro de otro bucle cogera el primer productcode y buscara el productname que le corresponde).
					$stmt = $conn->prepare("SELECT ProductName FROM Products WHERE ProductCode=:productcode");
					
					$stmt-> bindParam(":productcode",$productCode);
			
					$stmt->execute();
					
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
					$resultado=$stmt->fetchAll();
					
					foreach($resultado as $row) {
						
						$productName=$row["ProductName"];
					}
				
				echo "<b>OrderNumber " . $array_orderNumber[$i] . "</b><br>";
				
				echo "OrderLineNumber: " . $orderLineNumber .  "<br>";
				
				echo "ProductName: " . $productName .  "<br>";
				
				echo "QuantityOrdered: " . $quantityOrdered .  "<br>";
				
				echo "PriceEach: " . $priceEach .  "<br>";
				
				echo "ProductCode: " . $productCode .  "<br><br>";	
			}
		}
	};

	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};




?>