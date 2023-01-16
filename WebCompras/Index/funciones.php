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

/*	function comp_Cantidad($id_prod,$cant,$conn){
		
		$array_numAlm=array();
		
		$array_idProd=array();
		
		$array_cantProd=array();
		
		$total=0;
		
		//Instruccion SQL donde guardamos la suma de las cantidades del id_producto indicado//
		$stmt = $conn->prepare("SELECT SUM(CANTIDAD) TOTAL FROM ALMACENA WHERE ID_PRODUCTO=:id_prod");
		
		$stmt-> bindParam(":id_prod",$id_prod);
			
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$cant_prod=$row["TOTAL"];

		}
		//Condicion donde comprobamos si la cantidad total del producto es menor a la cantidad solicitada//
		if($cant_prod < $cant){
			
			echo "<b>Mensaje:</b><br>";
			
			echo "Cantidad solicitada mayor a la almacenada" . "<br>";
			
			return false;
		}
		else{
			//Instruccion sql donde guardamos num_almacen y cantidad del id_producto seleccionado//
			$stmt = $conn->prepare("SELECT NUM_ALMACEN, CANTIDAD FROM ALMACENA WHERE ID_PRODUCTO=:id_prod");
		
			$stmt-> bindParam(":id_prod",$id_prod);
				
			$stmt->execute();
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);		
			
			$resultado=$stmt->fetchAll();
									 
			foreach($resultado as $row) {
				//Guardamos los datos en un array//
				array_push($array_numAlm,$row["NUM_ALMACEN"]);
				
				array_push($array_cantProd,$row["CANTIDAD"]);

			}
			//Recorremos uno de los array//
			for($i = 0 ; $i < count($array_numAlm) ; $i++){
				
				//Condicion donde comprobamos si el elemento del array cantidades es menor a la cantidad pedida//
				if($array_cantProd[$i] < $cant){
					
					//Guardar la resta de la cantidad solicitada menos el elemento del array en el la variable total//
					$total=$cant-$array_cantProd[$i];
					
					//El valor del elemento del array pasa a ser 0.
					$array_cantProd[$i]=0;
					
					//Instruccion SQL donde actualizamos el dato de cantidad por el valor 0//
					$stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD=:valor WHERE NUM_ALMACEN=:num_almacen AND ID_PRODUCTO=:id_prod");
		
					$stmt-> bindParam(":valor",$array_cantProd[$i]);
					
					$stmt-> bindParam(":num_almacen",$array_numAlm[$i]);
					
					$stmt-> bindParam(":id_prod",$id_prod);
						
					$stmt->execute();
					
					//Como el resultado de la resta nos un numero negativo lo cambiamos a positivo//
					abs($total);
					
					//Ahora la cantida solicitada tiene como valor lo que haya en total, que es el resultado de la resta//
					$cant=$total;
					
				}
				else{	//En caso de que la cantidad sea menor al elemento del array
				
					//Guardamos en total la resta del elemento del array menos la cantidad solicitada//
					$total=$array_cantProd[$i]-$cant;
					
					//Cambiamos el valor de la cantidad solicitada a 0//
					$cant=0;
					
					//Instruccion SQL donde actualizamos el valor de la cantidad//
					$stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD=:total WHERE NUM_ALMACEN=:num_almacen AND ID_PRODUCTO=:id_prod");
					
					$stmt-> bindParam(":total",$total);
		
					$stmt-> bindParam(":num_almacen",$array_numAlm[$i]);
					
					$stmt-> bindParam(":id_prod",$id_prod);
						
					$stmt->execute();
					
				}
			}
			
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
*/

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
}

?>