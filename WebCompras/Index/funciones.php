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
/*Registro en la base de datos de Registro*/
function registro ($nombre,$apellinv,$nif,$conn){
	
	$stmt = $conn->prepare('INSERT INTO REGISTRO (USUARIO , CLAVE , nif ) VALUES (:nombre , :apellinv , :nif)');
	
	$stmt->bindParam(':nombre', $nombre);
	
	$stmt->bindParam(':apellinv', $apellinv);
	
	$stmt->bindParam(':nif', $nif);
			
	$stmt->execute();
	
};
/*Registro en la base de datos de cliente*/
function registro2 ($nombre,$apell,$nif,$conn){
	
	$stmt = $conn->prepare('INSERT INTO CLIENTE (NOMBRE , APELLIDO , NIF ) VALUES (:nombre , :apell , :nif)');
	
	$stmt->bindParam(':nombre', $nombre);
	
	$stmt->bindParam(':apell', $apell);
	
	$stmt->bindParam(':nif', $nif);
			
	$stmt->execute();
	
	
};
/*Login usuarios*/
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

function obtener_nif ($usuario,$clave,$conn){
	
	$stmt = $conn->prepare('SELECT NIF FROM REGISTRO WHERE USUARIO=:usuario AND CLAVE=:clave');
	
	$stmt->bindParam(':usuario', $usuario);
	
	$stmt->bindParam(':clave', $clave);
			
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
	$resultado=$stmt->fetchAll();
								 
	foreach($resultado as $row) {
			
		$nif_cliente=$row["NIF"];

	}
	
	return $nif_cliente;
	
};

function obtener_precio($id_prod, $conn){
	
	$stmt = $conn->prepare('SELECT PRECIO FROM PRODUCTO WHERE ID_PRODUCTO=:id_prod');
	
	$stmt->bindParam(':id_prod', $id_prod);
			
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
	$resultado=$stmt->fetchAll();
								 
	foreach($resultado as $row) {
			
		$precio=$row["PRECIO"];

	}
	
	return $precio;
	
};

function obtener_precio_total($id_prod,$cant, $conn){
	
	$stmt = $conn->prepare('SELECT PRECIO FROM PRODUCTO WHERE ID_PRODUCTO=:id_prod');
	
	$stmt->bindParam(':id_prod', $id_prod);
			
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
	$resultado=$stmt->fetchAll();
								 
	foreach($resultado as $row) {
			
		$precio=$row["PRECIO"];

	}
	
	$precio_total = $precio * $cant;
	
	return $precio_total;
	
};

function obtener_nombre($id_prod, $conn){
	
	$stmt = $conn->prepare('SELECT NOMBRE FROM PRODUCTO WHERE ID_PRODUCTO=:id_prod');
	
	$stmt->bindParam(':id_prod', $id_prod);
			
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
	$resultado=$stmt->fetchAll();
								 
	foreach($resultado as $row) {
			
		$nombre=$row["NOMBRE"];

	}
	
	return $nombre;
	
};

function comprobar_cant($id_prod,$cant,$conn){
	
	$ok=false;
	
	$stmt = $conn->prepare('SELECT SUM(CANTIDAD) AS TOTAL FROM ALMACENA WHERE ID_PRODUCTO=:id_prod');
	
	$stmt->bindParam(':id_prod', $id_prod);
			
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
	$resultado=$stmt->fetchAll();
								 
	foreach($resultado as $row) {
			
		$cantidad=$row["TOTAL"];

	};
	
	if ($cant > $cantidad){
		
		echo 'La cantidad solicitada es mayor a la almacena, cambia la cantidad';
		
		$ok = false;
	}
	else{
		
		$ok = true;
	}
	
	return $ok;
	
};


/*
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
*/

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>