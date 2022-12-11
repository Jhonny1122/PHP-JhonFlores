<?php

function altadpto($nombre){
	
	if(empty($nombre)){
		
		echo "Es obligatorio introducir un nombre para el departamento.";
		
	}
	else{
		
		$servername = "localhost";
		
		$username = "root";
		
		$password = "rootroot";
		
		$dbname = "empleadosnn";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$stmt = $conn->prepare("INSERT INTO dpto (nombre) VALUES (:nombre)");
			
			$stmt->bindParam(":nombre", $nombre);
			
			if ($stmt->execute()) {
				
			  echo "Departamento añadido con exito." . "</br>";
			
			} else {
			
			echo "No se puedo añadir el departamento." . "</br>";
			}
		}
		catch(PDOException $e) {
			
			echo "Error: " . $e->getMessage();
		}
		
		$conn = null;
		
	}
};

function altaempleado($dni_emple,$nomb_emple,$salario_emple,$fnac_emple,$id_dpto){
	//Creamos una variable para almacenar el ID que necesitamos buscar.
	//$id_dpto=0;
	
	//Creamos una variable donde guardamos la fecha de hoy.
	$fecha=date("j-m-y");
	
	//Condicion donde vemos si esta vacio el dni del empleado.
	if(empty($dni_emple)){
		
		//Si es vacio mandara el mensaje.
		echo "Es obligatorio el DNI del empleado";	
	}
	else{
		//Guardamos en las variables siguientes los datos para conectarnos a la base de datos.
		$servername = "localhost";
		
		$username = "root";
		
		$password = "rootroot";
		
		$dbname = "empleadosnn";
		//Un try catch para controlar si da fallo.
		try{
			//Nos conectamos a la base de datos.
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			
			//setAttribute permite capturar los errores en tiempo de ejecucion(Cuando el problema ocurre al darle click en "comprobar")
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//Permite detectar todo tipo de caracter de utf8.
			$conn->exec("SET CHARACTER SET utf8");
			
			//Alta Empleado//
			//Generamos la consulta y lo guarda en $insertarEmple, :nombre son los marcadores.
			$insertarEmple = "INSERT INTO EMPLE (DNI,NOMBRE,SALARIO,FECHA_NAC) VALUES (:dni_emple,:nomb_emple,:salario_emple,:fnac_emple)";
			
			//Crea un PDOStatement donde prepara la instruccion $insertarEmple.
			$ejecucion1=$conn->prepare($insertarEmple);
			
			//Ejecutamos el PDOStatement y pasas por parametros un array con las variables.
			$ejecucion1->execute(array(":dni_emple"=>$dni_emple,":nomb_emple"=>$nomb_emple,":salario_emple"=>$salario_emple,":fnac_emple"=>$fnac_emple));
			/*
			//Buscar ID//
			//Generamos la consulta y lo guarda en $buscarID, :nombre son los marcadores(En este caso busca una ID de un nombre en concreto).
			$buscarID = "SELECT ID FROM DPTO WHERE NOMBRE=:nomb_dpto";
			
			//Crea un PDOStatement donde prepara la instruccion $buscarID.
			$ejecucion2=$conn->prepare($buscarID);
			
			//Ejecutamos el PDOStatement y pasas por parametros un array con la variable.
			$ejecucion2->execute(array(":nomb_dpto"=>$nomb_dpto));
			
			//Bucle donde recorre cada fila de $ejecucion2.
			while($registro=$ejecucion2->fetch(PDO::FETCH_ASSOC)){
				
				//echo "ID: " . $registro["ID"];
				//Guardamos en la variable el ID.
				$id_dpto=$registro["ID"];
			}
			*/
			//Alta en EMPLE_DPTO//
			$insertarEmpleDpto = "INSERT INTO EMPLE_DPTO (DNI_EMPLE,ID_DPTO,FECHA_INICIO) VALUES (:dni,:id,:fecha_ini)";
			
			$ejecucion3=$conn->prepare($insertarEmpleDpto);
			
			$ejecucion3->execute(array(":dni"=>$dni_emple,":id"=>$id_dpto,":fecha_ini"=>$fecha));
			
			//Mensaje que muestra lo siguiente si hay llegado hasta aqui sin errores.
			echo "Se ha resgitrado todo correctamente.";
			
		}
		catch(PDOException $e){
			
			die ("Error: " . $e->getMessage());
		}
		finally{
			
			$conn = null;
		}
		
	}
	
};

function cambiodpto ($dni_emple,$id_dpto_nuevo){
	
	$servername = "localhost";
	$username = "root";			
	$password = "rootroot";				
	$dbname = "empleadosnn";
	
	echo "<h2><b>Información</b></h2>";
	
	echo "DNI Empleado: " . $dni_emple . "<br>";
	
	try{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);			
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//Nombre del empleado
		$stmt = $conn->prepare("SELECT NOMBRE FROM EMPLE WHERE DNI=:dni_emple");
		$stmt->bindParam(":dni_emple", $dni_emple);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {						 
			$nombre_emple=$row["NOMBRE"];

		}
		echo "Nombre Empleado: " . $nombre_emple . "<br>";
		
		
		//Obtener nombre del departamento al que pertenece el empleado.
		$stmt = $conn->prepare("SELECT NOMBRE FROM DPTO WHERE ID=(SELECT ID_DPTO FROM EMPLE_DPTO WHERE DNI_EMPLE=:dni)");
		$stmt->bindParam(":dni", $dni_emple);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {						 
			$nombre_dpto=$row["NOMBRE"];

		}
		echo "Departamento Anterior: " . $nombre_dpto . "<br>";
		
		//Actualizar ID_DPTO del DNI_EMPLE
		$stmt = $conn->prepare("UPDATE EMPLE_DPTO SET ID_DPTO=:id_nuevo WHERE DNI_EMPLE=:dni");
		$stmt->bindParam(":id_nuevo", $id_dpto_nuevo);
		$stmt->bindParam(":dni", $dni_emple);
		$stmt->execute();
		
		//Nombre del departamento nuevo al que pertence.
		$stmt = $conn->prepare("SELECT NOMBRE FROM DPTO WHERE ID=:id_dpto");
		$stmt->bindParam(":id_dpto", $id_dpto_nuevo);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {						 
			$nombre_dpto_nuevo=$row["NOMBRE"];

		}
		
		echo "Departamento Nuevo: " . $nombre_dpto_nuevo . "<br>";
		
		//Fecha Modificacion
		$fecha=date("j-m-y");
		echo "Fecha Modificacion: " . $fecha . "<br>";
		
	}
	catch(PDOException $e){
		
		die ("Error: " . $e->getMessage());
	}
	finally{
			
		$conn = null;
	}
	
	
};

function cambioSalario($dni_emple,$sueldo_nuevo){
	
	$servername = "localhost";
	$username = "root";			
	$password = "rootroot";				
	$dbname = "empleadosnn";
	
	try{
		echo "<h2><b>Información</b></h2>";
		echo "DNI Empleado: " . $dni_emple . "<br>";
		
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);			
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//Nombre del empleado
		$stmt = $conn->prepare("SELECT NOMBRE FROM EMPLE WHERE DNI=:dni_emple");
		$stmt->bindParam(":dni_emple", $dni_emple);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {						 
			$nombre_emple=$row["NOMBRE"];

		}
		echo "Nombre Empleado: " . $nombre_emple . "<br>";
		//Salario Anterior
		$stmt = $conn->prepare("SELECT SALARIO FROM EMPLE WHERE DNI=:dni");
		$stmt->bindParam(":dni", $dni_emple);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {						 
			$sueldo=$row["SALARIO"];

		}
		
		echo "Sueldo Anterior: " . $sueldo . "<br>";
		
		//Actualizar Sueldo del Empleado usando el dni_emple.
		$stmt = $conn->prepare("UPDATE EMPLE SET SALARIO=:salario_nuevo WHERE DNI=:dni");
		$stmt->bindParam(":salario_nuevo", $sueldo_nuevo);
		$stmt->bindParam(":dni", $dni_emple);
		$stmt->execute();
		echo "Salario Nuevo: " . $sueldo_nuevo . "<br>";
	}
	catch(PDOException $e){
		
		die ("Error: " . $e->getMessage());
	}
	finally{
			
		$conn = null;
	}
	
};

function listarEmple($id_dpto){
	
	$servername = "localhost";
	$username = "root";			
	$password = "rootroot";				
	$dbname = "empleadosnn";
	
	try{
		
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);			
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$stmt = $conn->prepare("SELECT NOMBRE FROM EMPLE WHERE DNI =(SELECT DNI_EMPLE FROM EMPLE_DPTO WHERE ID_DPTO=:id)");
		$stmt->bindParam(":id", $id_dpto);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);		
		$resultado=$stmt->fetchAll();
								 
		foreach($resultado as $row) {						 
			
			$nomb_emple=$row["NOMBRE"];
			
			echo "Empleado: " . $nomb_emple .  "<br>";
		}
		
	}
	catch(PDOException $e){
		
		die ("Error: " . $e->getMessage());
	}
	
};

function limpiar($data){
	
	$data = trim($data);
	
	$data = stripslashes($data);
	
	$data = htmlspecialchars($data);
	
	return $data;
};

?>