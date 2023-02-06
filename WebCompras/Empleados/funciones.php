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

	function contCateg($conn){
		
		$stmt = $conn->prepare("SELECT count(nombre) FROM CATEGORIA");
		
		$stmt->execute();

		$arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$arrayAso = $stmt->fetchAll();
		
		return $arrayAso;
		
	};
	
	function incremCategoria($lineas){
		
		foreach($lineas as $row) {
			
			$numCategoria = $row["count(nombre)"];
			
		}

		$numCategoria++;
			
		$numCategoria=str_pad($numCategoria,1,"0",STR_PAD_LEFT);
			
		$codigoIncreCateg="C-".$numCategoria;
			
		return $codigoIncreCateg;
	};
	
	function contProd($conn){
		
		$stmt = $conn->prepare("SELECT count(nombre) FROM PRODUCTO");
		
		$stmt->execute();

		$arrayAso = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$arrayAso = $stmt->fetchAll();
		
		return $arrayAso;
		
	};
	
	function incremProd($lineas){
		
		foreach($lineas as $row) {
			
			$numCategoria = $row["count(nombre)"];
		}
			$numCategoria++;
			
			$codigoIncreCateg="P".$numCategoria;
			
			return $codigoIncreCateg;
	};
	
	function altaCategoria($nomb_categ,$incre,$conn){
		
		$stmt = $conn->prepare("INSERT INTO CATEGORIA (ID_CATEGORIA,NOMBRE) VALUES (:id_categ,:nomb_categ)");
		
		$stmt-> bindParam(":id_categ",$incre);
		
		$stmt-> bindParam(":nomb_categ",$nomb_categ);
		
		$stmt->execute();
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		echo "ID-Categoria: " . $incre . "<br>";
		
		echo "Nombre Categoria: " . $nomb_categ . "<br>";
		
		$conn = null;
		
	};
	
	function altaProducto($nomb_prod,$prec_prod,$id_categ,$incre,$conn){
		
		$stmt = $conn->prepare("INSERT INTO PRODUCTO (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) VALUES (:incre,:nomb_prod,:prec_prod,:id_categ)");
		
		$stmt-> bindParam(":incre",$incre);
		
		$stmt-> bindParam(":nomb_prod",$nomb_prod);
		
		$stmt-> bindParam(":prec_prod",$prec_prod);
		
		$stmt-> bindParam(":id_categ",$id_categ);
		
		$stmt->execute();
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		echo "ID-Producto: " . $incre . "<br>";
		
		echo "Nombre Producto: " . $nomb_prod . "<br>";
		
		echo "Precio Producto: " . $prec_prod . " $ " . "<br>";
		
		$stmt = $conn->prepare("SELECT NOMBRE FROM CATEGORIA WHERE ID_CATEGORIA=:id_categ");
		
		$stmt-> bindParam(":id_categ",$id_categ);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$nomb_categ=$row["NOMBRE"];

		}
		echo "Nombre Categoria: " . $nomb_categ . "<br>";
		
		echo "ID Categoria: " . $id_categ . "<br>";
		
		$conn = null;
		
	};
	
	function altaAlmacen($loc_alm,$conn){
		//Preparamos la isntruccion sql, donde pasamos un marcador de valor loc_alm.
		$stmt = $conn->prepare("INSERT INTO ALMACEN (LOCALIDAD) VALUE (:loc_alm)");
		//Asociamos el valor del marcador loc_alm por $loc_alm.
		$stmt-> bindParam(":loc_alm",$loc_alm);
		//Ejecutamos la isntruccion.
		$stmt->execute();
		//Imprimimos un par de mensajes.
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		echo "Localidad Almacen: " . $loc_alm . "<br>";
		//Preparamos la instruccions sql.
		$stmt = $conn->prepare("SELECT NUM_ALMACEN FROM ALMACEN WHERE LOCALIDAD=:loc_alm");
		//Asociamos el valor del marcador loc_alm por $loc_alm.
		$stmt-> bindParam(":loc_alm",$loc_alm);
		//Ejecutamos la isntruccion.
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$num_alm=$row["NUM_ALMACEN"];

		}
		echo "Numero de Almacen: " . $num_alm . "<br>";
		
		$conn = null;
		
	};
	
	function aprovProd($num_alm,$id_prod,$cant_alm,$conn){
		
		$repeDato=false;
		//Instruccion SQL para guardar los datos num_almacen , id_producto y cantidad , segun indicado el cliente //
		$stmt = $conn->prepare("SELECT * FROM ALMACENA WHERE NUM_ALMACEN=:num_alm AND ID_PRODUCTO=:id_prod");
		
		$stmt-> bindParam(":num_alm",$num_alm);
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
		//Recorremos el array asociativo//						 
		foreach($resultado as $row) {
			//Guardamos los valores
			$num_almacen=$row["NUM_ALMACEN"];
			
			$id_producto=$row["ID_PRODUCTO"];
			
			$cant_almacena=$row["CANTIDAD"];
			//Condicion donde comprobamos si el id_producto y el num_almacen ya estan en la base de datos//
			if($num_almacen == $num_alm && $id_producto == $id_prod){
				//Valor a true
				$repeDato=true;
			}
			else{
				//Valor false
				$repeDato=false;
			}

		}
		//Si la variable es true//
		if($repeDato){
			//Variable que guarda la suma de la cantidad almacenada en la BBDD y la cantidad a aprovisionar//
			$total=$cant_almacena+$cant_alm;
			//Instrucion SQL donde guardamos la nueva cantidad en el num_almacen e id_producto indicado//
			$stmt = $conn->prepare("UPDATE ALMACENA SET CANTIDAD=:cant_total WHERE NUM_ALMACEN=:num_alm AND ID_PRODUCTO=:id_prod");
		
			$stmt-> bindParam(":num_alm",$num_alm);
			
			$stmt-> bindParam(":id_prod",$id_prod);
			
			$stmt-> bindParam(":cant_total",$total);
			
			$stmt->execute();
			
		}
		else{
			//Instruccion SQL donde se guarda los datos pasados//
			$stmt = $conn->prepare("INSERT INTO ALMACENA (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) VALUES (:num_alm,:id_prod,:cant)");
		
			$stmt-> bindParam(":num_alm",$num_alm);
			
			$stmt-> bindParam(":id_prod",$id_prod);
			
			$stmt-> bindParam(":cant",$cant_alm);
			
			$stmt->execute();
			
		}
		
		//Imprimimos mensajes//
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		$stmt = $conn->prepare("SELECT LOCALIDAD FROM ALMACEN WHERE NUM_ALMACEN=:num_alm");
		
		$stmt-> bindParam(":num_alm",$num_alm);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$loc_alm=$row["LOCALIDAD"];

		}
		
		echo "Nombre Localidad: " . $loc_alm . "<br>";
		
		echo "Numero de Almacen: " . $num_alm . "<br>";
		
		$stmt = $conn->prepare("SELECT NOMBRE FROM PRODUCTO WHERE ID_PRODUCTO=:id_prod");
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$nomb_prod=$row["NOMBRE"];

		}
		
		echo "Nombre Producto: " . $nomb_prod . "<br>";
		
		echo "ID Producto: " . $id_prod . "<br>";
		
		echo "Cantidad Almacenada: " . $cant_alm . " productos <br>";
		
		$conn = null;
		
	};
	
	function consStock($id_prod,$conn){
		//Arrays para guardar informacion sobre los nombres de las localidades.
		$nomb_loc=array();
		//Array para guardar informacion sobre la cantidad de los productos.
		$cant_prod=array();
		
		$total=0;
		//Instruccion sql.
		$stmt = $conn->prepare("SELECT LOCALIDAD FROM ALMACEN WHERE NUM_ALMACEN IN (SELECT NUM_ALMACEN FROM ALMACENA WHERE ID_Producto=:id_prod)");
		//Asociamos el marcador con el id_prod.
		$stmt-> bindParam(":id_prod",$id_prod);
		//Ejecutamos
		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		//Recorremos el array asociativo.
		foreach($resultado as $row) {
			//Guardamos las datos que recoge en el array $nomb_loc.
			array_push($nomb_loc,$row["LOCALIDAD"]);
		}
		//Instruccion sql.
		$stmt = $conn->prepare("SELECT CANTIDAD FROM ALMACENA WHERE ID_PRODUCTO=:id_prod");
		//Asociamos el marcador con el id_prod.
		$stmt-> bindParam(":id_prod",$id_prod);
		//Ejecutamos
		$stmt->execute();

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$resultado=$stmt->fetchAll();
		//Recorremos el array asociativo.
		foreach($resultado as $row) {
			//Guardamos los datos en el array $cant_prod.
			array_push($cant_prod,$row["CANTIDAD"]);
		}
		//Imprimimos mensajes.
		echo "<h3>Informacion sobre Stock</h3>";
		
		echo "ID Producto: " . $id_prod . "<br>";
		
		$stmt = $conn->prepare("SELECT NOMBRE FROM PRODUCTO WHERE ID_Producto=:id_prod");
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$nomb_prod=$row["NOMBRE"];

		}
		echo "Nombre Producto: " . $nomb_prod. "<br>";
		
		//Guardamos el numero de elementos que tiene el array.
		$vueltas=count($nomb_loc);
		
		if($vueltas==0){
			
			echo "Producto sin almacen ni cantidad.";
		}
		else{
			
			for($i = 0 ; $i < $vueltas ; $i++){
			
			echo "Localidad: " . $nomb_loc[$i] . ", Cantidad: " . $cant_prod[$i] . "<br>";
			
			$total+=$cant_prod[$i];
			}
		};
		
		echo "Cantidad Total: " . $total . "<br>";
		//Cerramos la conexion.
		$conn = null;
		
	};
	
	function consAlm($num_alm,$conn){
		
		$nomb_prod_arr=array();
		
		//Instruccion SQL donde cogemos el dato de Nombre dando unas condiciones. Y lo guardamos en un array.
		$stmt = $conn->prepare("SELECT NOMBRE FROM PRODUCTO WHERE ID_PRODUCTO IN ( SELECT ID_PRODUCTO FROM ALMACENA WHERE NUM_ALMACEN=:num_alm)");
		
		$stmt-> bindParam(":num_alm",$num_alm);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			array_push($nomb_prod_arr,$row["NOMBRE"]);
		}
		
		echo "<h3>Informacion sobre la Consulta</h3>";
		
		echo "Numero de Almacen: " . $num_alm . "<br>";
		
		//Instruccion SQL donde cogemos el dato de Localidad del num_alm indicado.
		$stmt = $conn->prepare("SELECT LOCALIDAD FROM ALMACEN WHERE NUM_ALMACEN=:num_alm");
		
		$stmt-> bindParam(":num_alm",$num_alm);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$loc=$row["LOCALIDAD"];

		}
		echo "Localidad: " . $loc. "<br>";
		
		for ($i = 0 ; $i < count($nomb_prod_arr) ; $i++){
			
			echo "Producto: " . $nomb_prod_arr[$i] . "<br>";
		}
		
		$conn = null;
		
	};
	
	function cons_Compra($nif_cliente,$fecha_desde,$fecha_hasta,$conn){
		
		$totalCompra=0;
		
		$id_prod_array=array();
		
		$fech_comp_arr=array();
		
		//Instruccion SQL donde cogemos los datos de ID y Fecha del nif y fechas indicados.
		$stmt = $conn->prepare("SELECT ID_PRODUCTO,FECHA_COMPRA FROM COMPRA WHERE NIF=:nif_cliente AND FECHA_COMPRA >=:fecha_desde AND FECHA_COMPRA <=:fecha_hasta");	
		
		$stmt-> bindParam(":nif_cliente",$nif_cliente);
		
		$stmt-> bindParam(":fecha_desde",$fecha_desde);
		
		$stmt-> bindParam(":fecha_hasta",$fecha_hasta);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			array_push($id_prod_array,$row["ID_PRODUCTO"]);
			
			array_push($fech_comp_arr,$row["FECHA_COMPRA"]);
		}
		
		echo "<h3>Informacion Compras</h3>";
		
		//Instruccion SQL donde cogemos los valores de Nombre y Apellido del nif indicado.
		$stmt = $conn->prepare("SELECT NOMBRE, APELLIDO FROM CLIENTE WHERE NIF=:nif_cliente");	
		
		$stmt-> bindParam(":nif_cliente",$nif_cliente);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
			
		$resultado=$stmt->fetchAll();
									 
		foreach($resultado as $row) {
				
			$nomb_cl=$row["NOMBRE"];
			
			$apell_cl=$row["APELLIDO"];

		}
			
		echo "NIF Cliente: " . $nif_cliente . "<br>";
		
		echo "Nombre: " . $nomb_cl . " " . $apell_cl . "<br><br>";
		
		//Recorremos uno a uno los elementos del array//
		for ($i = 0 ; $i < count($id_prod_array) ; $i++){
			
			echo "<b> Fecha de compra: " . $fech_comp_arr[$i] . "</b><br>" ;
			
			echo "Id Producto: " . $id_prod_array[$i] . "<br>";
			//Instruccion SQL donde cogemos los datos de Nombre y precio del id indicado.
			$stmt = $conn->prepare("SELECT NOMBRE, PRECIO FROM PRODUCTO WHERE ID_PRODUCTO=:id");
			
			$stmt-> bindParam(":id",$id_prod_array[$i]);
			
			$stmt->execute();
		
			$stmt->setFetchMode(PDO::FETCH_ASSOC);		
			
			$resultado=$stmt->fetchAll();
									 
			foreach($resultado as $row) {
				
				$nomb_prod=$row["NOMBRE"];
				
				$prec_prod=$row["PRECIO"];

			}
			
			echo "Nombre Producto: " . $nomb_prod . "<br>";
			
			echo "Precio: " . $prec_prod . "<br>";
			//Instruccion SQL donde cogemos el dato de Unidad del id y fecha indicado.
			$stmt = $conn->prepare("SELECT UNIDADES FROM COMPRA WHERE ID_PRODUCTO=:id AND FECHA_COMPRA=:fecha");
			
			$stmt-> bindParam(":id",$id_prod_array[$i]);
			
			$stmt-> bindParam(":fecha",$fech_comp_arr[$i]);
			
			$stmt->execute();
		
			$stmt->setFetchMode(PDO::FETCH_ASSOC);		
			
			$resultado=$stmt->fetchAll();
									 
			foreach($resultado as $row) {
				
				$unidades=$row["UNIDADES"];

			}
			
			echo "Cantidad: " . $unidades . "<br>";
			
			$total=$prec_prod*$unidades;
			
			echo "Total: " . $total . "<br>";
			
			$totalCompra+=$total;
			
			$total=0;
			
		}
		
		echo "<b>Total de la compra: </b>" . $totalCompra . "<br>";
		
		$conn = null;
	};
	
	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};
	
?>
