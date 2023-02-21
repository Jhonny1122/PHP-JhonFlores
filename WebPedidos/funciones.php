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
	
	/********************* Ejercicio 7 *********************/
	function consultar_compras($number,$f_inicio,$f_fin,$conn){
		
		echo "<h3>Historial Compras</h3>";
		
		$stmt = $conn->prepare('SELECT customerNumber,checkNumber,paymentDate,amount FROM payments WHERE customerNumber=:number AND paymentDate >:inicio AND paymentDate <:fin');
	
		$stmt->bindParam(':number', $number);
		
		$stmt->bindParam(':inicio', $f_inicio);
		
		$stmt->bindParam(':fin', $f_fin);
				
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$check=$row["checkNumber"];
			
			$pay_date=$row["paymentDate"];
			
			$monto=$row["amount"];
			
			echo "<b>Fecha: " . $pay_date . "</b>" . "<br>";
			
			echo "CustomerNumber: " . $number . "<br>";
			
			echo "checkNumber: " . $check . "<br>";
			
			echo "amount: " . $monto . "<br><br>";
			
		};
		
	};
	
	function consultar_todo($number,$conn){
		
		echo "<h3>Historial Compras</h3>";
		
		$stmt = $conn->prepare('SELECT customerNumber,checkNumber,paymentDate,amount FROM payments WHERE customerNumber=:number');
	
		$stmt->bindParam(':number', $number);
				
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$check=$row["checkNumber"];
			
			$pay_date=$row["paymentDate"];
			
			$monto=$row["amount"];
			
			echo "<b>Fecha: " . $pay_date . "</b>" . "<br>";
			
			echo "CustomerNumber: " . $number . "<br>";
			
			echo "checkNumber: " . $check . "<br>";
			
			echo "amount: " . $monto . "<br><br>";
			
		};
		
	};
	
	/********************* Ejercicio 6 *********************/
	function consulta_unidades($f_inicio,$f_fin,$conn){
		
		$stmt = $conn->prepare("SELECT SUM(quantityOrdered) AS totalUnints, products.productCode,products.productName  FROM orders,orderdetails, products WHERE orders.orderNumber=orderdetails.orderNumber AND orderdetails.productCode=products.productCode AND orderDate BETWEEN :fechaDesde AND :fechaHasta GROUP BY productCode");     
		
		$stmt -> bindParam(':fechaDesde',$f_inicio);
		
		$stmt -> bindParam(':fechaHasta',$f_fin);
		
		$stmt->execute();
		
		$arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$arrayAso = $stmt->fetchAll(); 
		
		return  $arrayAso;

		
	};
	
	
	/********************* Ejercicio 5 *********************/
	function consultaStock2($prod_line,$conn){
		
		$contador=1;
		
		echo "<h3>Informa de stock</h3>";
		
		echo "<h4>Mayor disponibilidad a menor</h4>";
			
		$stmt = $conn->prepare('SELECT productCode,productName,productLine,quantityInStock FROM Products WHERE productLine=:linea ORDER BY quantityInStock DESC');
	
		$stmt->bindParam(':linea', $prod_line);
				
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$prod_code=$row["productCode"];
			
			$prod_name=$row["productName"];
			
			$stock=$row["quantityInStock"];
			
			echo $contador . "--->" . "<br>" . "ProductCode: " . $prod_code . " , producName: " . $prod_name . " , ProductLine: " . $prod_line . " , QuantityInStock: " . $stock . "<br>";
			
			$contador++;
		};
	};

	
	
	
	/********************* Ejercicio 4 *********************/
	
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
	
	
	/********************* Ejercicio 3 *********************/
	
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

		for ($i = 0 ; $i < count($array_orderNumber) ; $i++){

			$stmt = $conn->prepare("SELECT OrderLineNumber , PriceEach , QuantityOrdered , ProductCode from OrderDetails WHERE OrderNumber=:ordernumber ORDER BY OrderLineNumber ASC");

			$stmt-> bindParam(":ordernumber",$array_orderNumber[$i]);
		
			$stmt->execute();
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			$resultado=$stmt->fetchAll();

			foreach($resultado as $row) {
			
				$orderLineNumber=$row["OrderLineNumber"];
				
				$priceEach=$row["PriceEach"];
				
				$quantityOrdered=$row["QuantityOrdered"];

				$productCode=$row["ProductCode"];

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
	
	/********************* Ejercicio 2 *********************/

	/*Funcion donde pasamos por parametro un id y devolvemos su precio.*/
	function obtener_precio($id_prod,$conn){
		
		$stmt = $conn->prepare("SELECT BuyPrice FROM Products WHERE ProductCode=:productcode");
					
		$stmt-> bindParam(":productcode",$id_prod);
		
		$stmt->execute();
					
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		$resultado=$stmt->fetchAll();
					
		foreach($resultado as $row) {
						
			$precio=$row["BuyPrice"];
		}
		
		return $precio;
	};
	/*Funcion donde cogemos el max de la tabla orders y lo enviamos aumentandolo en 1.*/
	function generarOrderNumber($conn){
		
		$stmt = $conn->prepare("SELECT MAX(OrderNumber) AS MAXIMO FROm Orders");
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		
		foreach($resultado as $row) {
			
			$maximo=$row["MAXIMO"];
		};
		
		$maximo=$maximo+1;
		
		return $maximo;
		
	};
	/*Funcion insertar datos en las tablas de orders y orderdetails*/
	function insertar_datos($carrito,$customer_numb,$conn){
		
		$status="shipped";
		
		$restante=0;
		
		foreach($carrito as $key => $value){
			//Generamos un order number, cogemos el maximo y le aumentamos en uno.
			$order_Number = generarOrderNumber(conexion());
			//Consulta para guardar los siguiente valores dentro de orders.
			$stmt = $conn->prepare("INSERT INTO Orders (OrderNumber,OrderDate,RequiredDate,ShippedDate,Status,CustomerNumber) VALUES (:ordernumber,:orderdate,:requireddate,:shippeddate,:status,:customernumber)");
			
			$stmt-> bindParam(":ordernumber",$order_Number);
		
			$stmt-> bindParam(":orderdate",$value['F_pedido']);
			
			$stmt-> bindParam(":requireddate",$value['F_solicitud']);
			
			$stmt-> bindParam(":shippeddate",$value['F_Envio']);
			
			$stmt-> bindParam(":status",$status);
			
			$stmt-> bindParam(":customernumber",$customer_numb);
			
			$stmt->execute();
			//Consulta para guardar los siguientes valores dentro de orderdetails.
			$stmt = $conn->prepare("INSERT INTO OrderDetails (OrderNumber,ProductCode,QuantityOrdered,PriceEach,OrderLineNumber) VALUES (:ordernumber,:productcode,:quantityordered,:priceeach,:orderlinenumber)");
			
			$stmt-> bindParam(":ordernumber",$order_Number);
		
			$stmt-> bindParam(":productcode",$value['ID_Producto']);
			
			$stmt-> bindParam(":quantityordered",$value['Cantidad']);
			
			$stmt-> bindParam(":priceeach",$value['Precio']);
			
			$stmt-> bindParam(":orderlinenumber",$value['OrderLine']);
			
			$stmt->execute();
		};
		
		return true;
	};
	/*Funcion de consulta de stcok de producto, le pasamos por parametro el carrito.*/
	function consultar_stock($carrito,$conn){
		
		$ok_stock=false;
		
		$contador=0;
		
		foreach($carrito as $key => $value){
			
			$stmt = $conn->prepare("SELECT ProductName FROM Products WHERE ProductCode=:productcode");
				
			$stmt-> bindParam(":productcode",$value['ID_Producto']);
					
			$stmt->execute();
					
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
			$resultado=$stmt->fetchAll();
								
			foreach($resultado as $row) {
									
				$nombre=$row["ProductName"];
			}
				
			$stmt = $conn->prepare("SELECT QuantityInStock FROM Products WHERE ProductCode=:productcode");
				
			$stmt-> bindParam(":productcode",$value['ID_Producto']);
					
			$stmt->execute();
					
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
			$resultado=$stmt->fetchAll();
								
			foreach($resultado as $row) {
									
				$stock=$row["QuantityInStock"];
			}
			
			if($stock < $value['Cantidad'] ){
				
				echo "La cantidad solicitada del producto " . $nombre . " es mayor a la del stock" . "<br>";
				
				echo "No se puede seguir con el proceso, cambie la cantidad o vacie la cesta" . "<br>";
				
				$contador++;
			}
			
		}
		
		if($contador == 0)
			
			$ok_stock=true;
		
		return $ok_stock;
		
	};
	/*FUncion para isnertar los datos del pago pasando por parametro el carrito.*/
	function insertar_pago($id_cliente,$num_pago,$fecha_actual,$precio_final,$conn){
		
		$ok_pago=false;
		
		if(empty($id_cliente) || empty($num_pago) || empty($fecha_actual) || empty($precio_final)){
			
			echo "Necesitas rellenar todos los campos" . "<br>";
			
			$ok_pago=false;
		}
		else{
			
			$stmt = $conn->prepare("INSERT INTO Payments (CustomerNumber,CheckNumber,PaymentDate,Amount) VALUES (:customernumber,:checknumber,:paymentdate,:amount)");
			
			$stmt-> bindParam(":customernumber",$id_cliente);
			
			$stmt-> bindParam(":checknumber",$num_pago);
				
			$stmt-> bindParam(":paymentdate",$fecha_actual);
				
			$stmt-> bindParam(":amount",$precio_final);
				
			$stmt->execute();
			
			$ok_pago=true;
		}
		
		return $ok_pago;
	};
	
	
	/*Funcion para actualizaar la cantidad en stock de los productos*/
	function actualizar_cantidad($carrito,$conn){
		
		foreach($carrito as $key => $value){
			
			$stmt = $conn->prepare("SELECT QuantityInStock FROM Products WHERE ProductCode=:productcode");
				
			$stmt-> bindParam(":productcode",$value['ID_Producto']);
					
			$stmt->execute();
					
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
			$resultado=$stmt->fetchAll();
								
			foreach($resultado as $row) {
									
				$cuantia=$row["QuantityInStock"];
			}
				
			$cuantia=$cuantia-$value['Cantidad'];
					
			$restante=$cuantia;
					
			$stmt = $conn->prepare("UPDATE Products SET QuantityInStock=:restante WHERE ProductCode=:productcode");
				
			$stmt-> bindParam(":restante",$restante);
					
			$stmt-> bindParam(":productcode",$value['ID_Producto']);
					
			$stmt->execute();
		}
		
		return true;
		
	};
	/*Funcion para calcular el precio final pasando por parametro el carrito.*/
	function precio_total($carrito){
		
		$fPrecioTotal=0;
		
		foreach($carrito as $key => $value){
			
			$fPrecioTotal += $value['Precio'] * $value['Cantidad'];
			
		}
		
		return $fPrecioTotal;
		
	};
	
	



	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};




?>