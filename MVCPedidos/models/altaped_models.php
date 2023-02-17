<?php

	/*Funcion donde pasamos por parametro un id y devolvemos su precio.*/
	function obtener_precio($id_prod){
		
		global $conn;
		
		try{
			
			$stmt = $conn->prepare('SELECT BuyPrice FROM Products WHERE ProductCode=:productcode');
					
			$stmt-> bindParam(":productcode",$id_prod);
			
			$stmt->execute();
						
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
			$resultado=$stmt->fetchAll();
						
			foreach($resultado as $row) {
							
				$precio=$row["BuyPrice"];
			}
			
			return $precio;
			
		}
		catch(PDOException $ex){
			
			echo "Error". $ex->getMessage();
			
			return null;
		}
		
	};
	/*Funcion donde cogemos el max de la tabla orders y lo enviamos aumentandolo en 1.*/
	function generarOrderNumber(){
		
		global $conn;
		
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
	function insertar_datos($carrito,$customer_numb){
		
		global $conn;
		
		$status="shipped";
		
		$restante=0;
		
		foreach($carrito as $key => $value){
			//Generamos un order number, cogemos el maximo y le aumentamos en uno.
			$order_Number = generarOrderNumber();
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
	function consultar_stock($carrito){
		
		global $conn;
		
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
	function insertar_pago($id_cliente,$num_pago,$fecha_actual,$precio_final){
		
		global $conn;
		
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
	function actualizar_cantidad($carrito){
		
		global $conn;
		
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
	



?>