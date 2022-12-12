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

	function contarCat(){
		
        $archivo = "contador.txt";
        
		$f = fopen($archivo, "r+"); 
        
		if($f) {
        
			$contador = fread($f, filesize($archivo));
            
			$contador = $contador + 1; 
            
			fclose($f);
        }
		
        $f = fopen($archivo, "w+");
        
		if($f) {
        
			fwrite($f, $contador);
            
			fclose($f);
        }
		
        return $contador;
    };
	
	function contarProd(){
		
        $archivo = "contadorProd.txt";
        
		$f = fopen($archivo, "r+");
        
		if($f) {
        
			$contador = fread($f, filesize($archivo));
            
			$contador = $contador + 1; 
            
			fclose($f);
        }
		
        $f = fopen($archivo, "w+");
        
		if($f) {
        
			fwrite($f, $contador);
            
			fclose($f);
        }
		
        return $contador;
    };
	
	function altaCategoria($nomb_categ,$numero,$conn){
		
		$id_categ="C-" . $numero;
		
		$stmt = $conn->prepare("INSERT INTO CATEGORIA (ID_CATEGORIA,NOMBRE) VALUES (:id_categ,:nomb_categ)");
		
		$stmt-> bindParam(":id_categ",$id_categ);
		
		$stmt-> bindParam(":nomb_categ",$nomb_categ);
		
		$stmt->execute();
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		echo "ID-Categoria: " . $id_categ . "<br>";
		
		echo "Nombre Categoria: " . $nomb_categ . "<br>";
		
		$conn = null;
		
	};
	
	function altaProducto($nomb_prod,$prec_prod,$id_categ,$id_prod,$conn){
		
		$id_prod="P" . $id_prod;
		
		$stmt = $conn->prepare("INSERT INTO PRODUCTO (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) VALUES (:id_prod,:nomb_prod,:prec_prod,:id_categ)");
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt-> bindParam(":nomb_prod",$nomb_prod);
		
		$stmt-> bindParam(":prec_prod",$prec_prod);
		
		$stmt-> bindParam(":id_categ",$id_categ);
		
		$stmt->execute();
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		echo "ID-Producto: " . $id_prod . "<br>";
		
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
		
		$stmt = $conn->prepare("INSERT INTO ALMACENA (NUM_ALMACEN,ID_PRODUCTO,CANTIDAD) VALUES (:num_alm,:id_prod,:cant)");
		
		$stmt-> bindParam(":num_alm",$num_alm);
		
		$stmt-> bindParam(":id_prod",$id_prod);
		
		$stmt-> bindParam(":cant",$cant_alm);
		
		$stmt->execute();
		
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
			
			}
		};
		//Cerramos la conexion.
		$conn = null;
		
	};
	
	function consAlm($num_alm,$conn){
		
		$nomb_prod_arr=array();
		
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
		
	};
	
	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};
	
	
	
	
	
	
	

?>