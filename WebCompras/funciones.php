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
		
		
	};
	
	function altaAlmacen($loc_alm,$conn){
		
		$stmt = $conn->prepare("INSERT INTO ALMACEN (LOCALIDAD) VALUE (:loc_alm)");
		
		$stmt-> bindParam(":loc_alm",$loc_alm);
		
		$stmt->execute();
		
		echo "<h3>Informacion sobre el Resgistro</h3>";
		
		echo "Localidad Almacen: " . $loc_alm . "<br>";
		
		$stmt = $conn->prepare("SELECT NUM_ALMACEN FROM ALMACEN WHERE LOCALIDAD=:loc_alm");
		
		$stmt-> bindParam(":loc_alm",$loc_alm);
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {
			
			$num_alm=$row["NUM_ALMACEN"];

		}
		echo "Numero de Almacen: " . $num_alm . "<br>";
		
	};
	
	function limpiar($data){
	
		$data = trim($data);
		
		$data = stripslashes($data);
		
		$data = htmlspecialchars($data);
		
		return $data;
	};
	
	
	
	
	
	
	

?>