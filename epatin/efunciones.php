<?php
	
	//*****************  Funcion Conexion  *****************//
	
	function conexion (){
		
		$servername = "localhost";
				
		$username = "root";
				
		$password = "rootroot";
				
		$dbname = "epatin";
				
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

	function get_login($email,$password,$conn){
		
		$stmt = $conn->prepare('SELECT * FROM eclientes WHERE email=:email AND dni=:password');
	
		$stmt->bindParam(':email', $email);
		
		$stmt->bindParam(':password', $password);
				
		$stmt->execute();
		
		$num_registro=$stmt->rowCount();
		
		if($num_registro != 0){

			session_start();

			$_SESSION["usuario"]=$_POST["password"];

			header("location:einicio.php");
		}
		else{

			header("location:elogin.php");
		}
		
	};
	
	
	//*****************  Funcion Obtener Nombre Cliente  *****************//
	
	function get_Nombre($dni,$conn){
		
		$stmt = $conn->prepare("SELECT Nombre FROM eclientes WHERE dni=:dni");
					
		$stmt-> bindParam(":dni",$dni);
		
		$stmt->execute();
					
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		$resultado=$stmt->fetchAll();
					
		foreach($resultado as $row) {
						
			$nombre=$row["Nombre"];
		}
		
		return $nombre;
		
		
	};
	
	
	//*****************  Funcion Obtener Saldo Cliente  *****************//
	
	function get_Saldo($dni,$conn){
		
		$stmt = $conn->prepare("SELECT Saldo FROM eclientes WHERE dni=:dni");
					
		$stmt-> bindParam(":dni",$dni);
		
		$stmt->execute();
					
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		$resultado=$stmt->fetchAll();
					
		foreach($resultado as $row) {
						
			$saldo=$row["Saldo"];
		}
		
		return $saldo;
		
		
	};
	
	
	//*****************  Funcion Obtener Bateria Patinetes  *****************//

	function get_Bateria($matricula,$conn){
		
		$stmt = $conn->prepare("SELECT Bateria FROM epatines WHERE matricula=:matricula");
					
		$stmt-> bindParam(":matricula",$matricula);
		
		$stmt->execute();
					
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		$resultado=$stmt->fetchAll();
					
		foreach($resultado as $row) {
						
			$bateria=$row["Bateria"];
		}
		
		return $bateria;
		
	};
	
	
	//*****************  Funcion Obtener Precio/Base Patinetes  *****************//

	function get_Precio($matricula,$conn){
		
		$stmt = $conn->prepare("SELECT PrecioBase FROM epatines WHERE matricula=:matricula");
					
		$stmt-> bindParam(":matricula",$matricula);
		
		$stmt->execute();
					
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
					
		$resultado=$stmt->fetchAll();
					
		foreach($resultado as $row) {
						
			$precio=$row["PrecioBase"];
		}
		
		return $precio;
		
	};
	
	
	//*****************  Funcion Insertar Datos Alquiler  *****************//
	
	function set_patines($carrito,$dni,$conn){
		
		foreach($carrito as $key => $value){
			
			$stmt = $conn->prepare("INSERT INTO ealquileres (dni,matricula,fecha_alquiler) VALUES (:dni,:matricula,:fecha)");
			
			$stmt-> bindParam(":dni",$dni);
			
			$stmt-> bindParam(":matricula",$value['Matricula']);
					
			$stmt-> bindParam(":fecha",$value['Fecha']);
					
			$stmt->execute();
		}
		
		//echo "Todos los patine añadidos con exito";
	};
	
	
	//*****************  Funcion Actualizar Disponibilidad Patines a No  *****************//

	function update_dispo($carrito,$conn){
		
		foreach($carrito as $key => $value){
			
			$stmt = $conn->prepare("UPDATE epatines SET disponible='N' WHERE matricula=:matricula");
				
			$stmt-> bindParam(":matricula",$value['Matricula']);
					
			$stmt->execute();
			
		}
		
		//echo "Todos los patines actualizado a no";
		
	};
	
	
	//*****************  Funcion Calcular Precio Total  *****************//
	function get_PrecioTotal($tiempo,$matricula,$conn){
		
		$precio_base=get_Precio($matricula,conexion());
		
		$precio_total=$precio_base*$tiempo;
		
		return $precio_total;
		
	};
	
	
	//*****************  Funcion Actualizar Datos Alquileres  *****************//
	function actualizar_alquileres($matricula,$fecha,$total,$conn){
			
		$stmt = $conn->prepare("UPDATE ealquileres SET fecha_devolucion=:fecha WHERE fecha_devolucion IS NULL AND preciototal IS NULL AND matricula=:matricula");
		
		$stmt-> bindParam(":fecha",$fecha);
				
		$stmt-> bindParam(":matricula",$matricula);
				
		$stmt->execute();	
		
		$stmt = $conn->prepare("UPDATE ealquileres SET preciototal=:total WHERE preciototal IS NULL AND matricula=:matricula");
		
		$stmt-> bindParam(":total",$total);
				
		$stmt-> bindParam(":matricula",$matricula);
				
		$stmt->execute();

		//echo "Fecha y total actualizados";		
	};
	
	
	//*****************  Funcion Saldo Cliente  *****************//
	function actualizar_saldos($dni,$saldo,$total,$conn){
		
		$resto=$saldo-$total;
		
		$stmt = $conn->prepare("UPDATE eclientes SET saldo=:resto WHERE dni=:dni");
		
		$stmt-> bindParam(":resto",$resto);
				
		$stmt-> bindParam(":dni",$dni);
				
		$stmt->execute();
		
		echo "Actualizado saldo del cliente" . "<br>";
		
	};
	
	
	//*****************  Funcion Disponibilidad Patines a SI  *****************//
	function actualizar_patinesS($matricula,$conn){
			
		$stmt = $conn->prepare("UPDATE epatines SET disponible='S' WHERE matricula=:matricula");
				
		$stmt-> bindParam(":matricula",$matricula);
				
		$stmt->execute();
			
		
	};
	
	
	//*****************  Funcion Consultar Pedidos  *****************//
	function consultar($dni,$f_desde,$f_hasta,$conn){
		
		$sHTML="";
		
		if(!empty($f_desde) && !empty($f_hasta)){
			
			$stmt = $conn->prepare("SELECT * FROM ealquileres WHERE dni=:dni AND fecha_alquiler >= :desde AND fecha_devolucion <= :hasta");
					
			$stmt-> bindParam(":dni",$dni);
			
			$stmt-> bindParam(":desde",$f_desde);
			
			$stmt-> bindParam(":hasta",$f_hasta);
			
			$stmt->execute();
						
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
			$resultado=$stmt->fetchAll();
						
			foreach($resultado as $row) {
							
				$matricula = $row["matricula"];
				
				$alquiler = $row["fecha_alquiler"];
				
				$devo = $row["fecha_devolucion"];
				
				$total = $row["preciototal"];
				
				$sHTML .= "Matricula: " . $matricula . "<br>" . "Fecha Alquiler: " . $alquiler . "<br>" . "Fecha Devolucion: " . $devo . "<br>" . "Importe Total a Pagar: " . $total . "<br><br>";
			}	
			
		}
		if(!empty($f_desde)){
			
			$stmt = $conn->prepare("SELECT * FROM ealquileres WHERE dni=:dni AND fecha_alquiler >= :desde");
					
			$stmt-> bindParam(":dni",$dni);
			
			$stmt-> bindParam(":desde",$f_desde);
			
			$stmt->execute();
						
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
						
			$resultado=$stmt->fetchAll();
						
			foreach($resultado as $row) {
							
				$matricula = $row["matricula"];
				
				$alquiler = $row["fecha_alquiler"];
				
				$devo = $row["fecha_devolucion"];
				
				$total = $row["preciototal"];
				
				$sHTML .= "Matricula: " . $matricula . "<br>" . "Fecha Alquiler: " . $alquiler . "<br>" . "Fecha Devolucion: " . $devo . "<br>" . "Importe Total a Pagar: " . $total . "<br><br>";
			}	
			
		}
		else{
			
			echo "Error. Es necesario poner la fecha desde";
		}
		
		return $sHTML;
	};
	
	
	
	
	
	
	
	
	
	
?>