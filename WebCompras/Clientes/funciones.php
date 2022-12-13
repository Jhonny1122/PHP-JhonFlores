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
	//Funcion comprueba si es valido el DNI//
	function validar_dni($nif){
		
		$letra = substr($nif, -1);
		
		$numeros = substr($nif, 0, 8);
		
		if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8 ){

			return true;
		}else{

			return false;
		}
	};
	//Funcion dar de alta Clientes//
	function alta_Cliente($nif,$nomb_cl,$apell_cl,$cp_cl,$dirr_cl,$ciud_cl,$conn){
		//Variable true o false//
		$nif_repe=false;
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		//Instruccion donde se guarda el nif de todos cliente//
		$stmt = $conn->prepare("SELECT NIF FROM CLIENTE");
		
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach($stmt->fetchAll() as $row) {
			//Condicion si algun nif de la base de datos es igual al nif pasado por parametro, cambia el valor de la varaible a true//
			if($nif == $row["NIF"]){
				
				$nif_repe=true;
			}
		}
		//Condicion del valor , si es true manda el mensaje sino hace lo siguiente//
		if($nif_repe==true){
			
			echo "NIF <b>Registrado</b>. Introduzca otro NIF";
		}
		else{
			//Instruccion SQL donde guardamos en la BBDD los datos del cliente//
			$stmt = $conn->prepare("INSERT INTO CLIENTE (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) VALUES (:nif,:nomb_cl,:apell_cl,:cp_cl,:dirr_cl,:ciud_cl)");
		
			$stmt-> bindParam(":nif",$nif);
			
			$stmt-> bindParam(":nomb_cl",$nomb_cl);
			
			$stmt-> bindParam(":apell_cl",$apell_cl);
			
			$stmt-> bindParam(":cp_cl",$cp_cl);
			
			$stmt-> bindParam(":dirr_cl",$dirr_cl);
			
			$stmt-> bindParam(":ciud_cl",$ciud_cl);
			
			$stmt->execute();
			
			//Instruccion SQL donde guardamos todos los datos del nombre indicado//
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
		//Cerrammos conexion//
		$conn = null;
		
	};
	
	function comp_Cantidad($id_prod,$cant,$conn){
		//Instruccion SQL donde guardamos la suma de las cantidades del id_producto indicado//
		$stmt = $conn->prepare("SELECT SUM(CANTIDAD) TOTAL FROM ALMACENA WHERE ID_PRODUCTO=:id_prod");
		
		$stmt-> bindParam(":id_prod",$id_prod);
			
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$cant_prod=$row["TOTAL"];

		}
		//Condicion donde comprobamos si la cantida total del producto es menor a la cantidad pasada por parametro//
		if($cant_prod < $cant){
			
			echo "<b>Mensaje:</b><br>";
			
			echo "Cantidad solicitada mayor a la almacenada" . "<br>";
			
			return false;
		}
		else{
			
			$cant_nueva=$cant_prod-$cant;
			//Instruccion SQL donde actualizamos la cantidad del id_producto indicado//
			$stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD=:cant_nueva WHERE ID_PRODUCTO=:id_prod");
		
			$stmt-> bindParam(":cant_nueva",$cant_nueva);
		
			$stmt-> bindParam(":id_prod",$id_prod);
					
			$stmt->execute();
			
			echo "<h3>Actualizacion</h3>";
			//Instruccion SQL donde cogemos el dato Nombre del id indicado//
			$stmt = $conn->prepare("SELECT NOMBRE FROM PRODUCTO WHERE ID_PRODUCTO=:id_prod");
		
			$stmt-> bindParam(":id_prod",$id_prod);
				
			$stmt->execute();
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);		
			
			$resultado=$stmt->fetchAll();
									 
			foreach($resultado as $row) {
				
				$nomb_prod=$row["NOMBRE"];

			}
			//Imprimimos mensaje//
			echo "Actualizado la cantidad de $nomb_prod <br> de $cant_prod a $cant_nueva" . "<br>";
			
			return true;
		}
		
		$conn = null;
		
	};
	
	function comprar($nif_cl,$id_prod,$fech_comp,$cant,$conn){
		//Instruccion SQL donde guardamos una nueva compra//
		$stmt = $conn->prepare("INSERT INTO COMPRA (NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES) VALUES (:nif_cl,:id_prod,:fech_comp,:cant)");
		
		$stmt-> bindParam(":nif_cl",$nif_cl);
			
		$stmt-> bindParam(":id_prod",$id_prod);
			
		$stmt-> bindParam(":fech_comp",$fech_comp);
			
		$stmt-> bindParam(":cant",$cant);
			
		$stmt->execute();
		//Instruccion SQL donde cogemos el daro Nombre del nif indicado//
		$stmt = $conn->prepare("SELECT NOMBRE FROM CLIENTE WHERE NIF=:nif_cl");
		
		$stmt-> bindParam(":nif_cl",$nif_cl);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$nomb_cl=$row["NOMBRE"];
		}
		//Instruccion SQL donde seleccionamos los datos de ciertos valores indicados//
		$stmt = $conn->prepare("SELECT NIF,ID_PRODUCTO,FECHA_COMPRA,UNIDADES FROM COMPRA WHERE NIF=:nif_cl AND ID_PRODUCTO=:id_prod AND FECHA_COMPRA=:fech_comp");
		
		$stmt-> bindParam(":nif_cl",$nif_cl);
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt-> bindParam(":fech_comp",$fech_comp);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$nif=$row["NIF"];
			
			$id=$row["ID_PRODUCTO"];
			
			$fecha=$row["FECHA_COMPRA"];
			
			$cantidad=$row["UNIDADES"];
		}
		//Imprimimos mensajes//
		echo "<h3>Informacion sobre la compra</h3>";
		
		echo "NIF cliente: " . $nif . "<br>";
		
		echo "Nombre cliente: " . $nomb_cl . "<br>";
			
		echo "Id Producto: " . $id . "<br>";
			
		echo "Fecha Compra: " . $fecha . "<br>";
			
		echo "Cantidad: " . $cantidad . "<br>";

		$conn = null;
		
	};
	
	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};
	
?>